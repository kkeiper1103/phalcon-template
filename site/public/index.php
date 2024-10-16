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

//
$container->set(\Psr\Http\Message\ServerRequestInterface::class, \Laminas\Diactoros\ServerRequestFactory::fromGlobals());
$container->set(\Psr\Http\Message\ResponseInterface::class, new \Laminas\Diactoros\Response());

foreach( $config->path('app.providers') as $provider ) {
    $container->register(new $provider);
}

$stack = new MiddlewareStack( new Application($container) );

$stack->addMiddleware(new \App\Middleware\StartSessionMiddleware( $container->get(\Phalcon\Session\Manager::class) ));
$stack->addMiddleware(new \App\Middleware\CsrfTokenMiddleware());

try {
    $response = $stack->handle($_SERVER['REQUEST_URI']);
}
catch(\App\Exceptions\TokenMismatchException $tme) {
    $view = $container->get(\Phalcon\Mvc\View\Simple::class);

    // Render the view and capture the output
    $content = $view->render('errors/403', ['error' => $tme]);

    // Output the rendered content
    $response = new \Phalcon\Http\Response($content, 500);
}
catch(Exception $e) {
    $view = $container->get(\Phalcon\Mvc\View\Simple::class);

    // Render the view and capture the output
    $content = $view->render('errors/500', ['error' => $e]);

    // Output the rendered content
    $response = new \Phalcon\Http\Response($content, 500);
}

$response->sendHeaders();
$response->sendCookies();
$response->send();