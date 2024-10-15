<?php

ini_set('display_errors', 'On');

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Middleware\MiddlewareStack;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Dotenv\Dotenv;

define('BASE_PATH', dirname(__DIR__) . '/');
const APP_PATH = BASE_PATH . '/src';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$container = new FactoryDefault();

$config = new \Phalcon\Config\Config();
$iter = new DirectoryIterator(BASE_PATH . '/config');
/**
 * @var SplFileInfo $fileInfo
 */
foreach($iter as $fileInfo) {
    if($fileInfo->isDot()) continue;

    list($name, $ext) = explode(".", $fileInfo->getFilename());

    $values = require_once BASE_PATH . '/config/' . $fileInfo->getFilename();
    $new = (new Phalcon\Config\Config([
        $name => $values
    ]));

    $config->merge($new);
}

foreach( $config->path('app.providers') as $provider ) {
    $container->register(new $provider);
}

$stack = new MiddlewareStack( new Application($container) );

$stack->addMiddleware(new \App\Middleware\StartSessionMiddleware());
$stack->addMiddleware(new \App\Middleware\CsrfTokenMiddleware());

try {
    $response = $stack->handle($_SERVER['REQUEST_URI']);
}
catch(\App\Exceptions\TokenMismatchException $tme) {
    $response = new \Phalcon\Http\Response("Token Mismatch", 403);
}
catch(Exception $e) {
    $response = new \Phalcon\Http\Response("Server Error: " . $e->getMessage(), 500);
}

$response->sendHeaders();
$response->sendCookies();
$response->send();