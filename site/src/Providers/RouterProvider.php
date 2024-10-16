<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\DispatcherInterface;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\RouterInterface;

class RouterProvider implements ServiceProviderInterface
{
    #[\Override]
    public function register(DiInterface $di): void
    {
        $di->set(RouterInterface::class, function() {
            $router = new Router(false);

            require_once BASE_PATH . '/routes/web.php';

            return $router;
        });

        $di->set('router', fn() => $di->get(RouterInterface::class));

        // set up the dispatcher, so no "mangling" occurs when resolving the controller and method to call
        // this allows us to route directly to Namespace\ClassName@index() instead of having to calculate what the values
        // should be to hit the right handler
        $di->setShared(DispatcherInterface::class, function() {
            $dispatcher = new Dispatcher();

            $dispatcher->setControllerSuffix("");
            $dispatcher->setActionSuffix("");

            return $dispatcher;
        });
        $di->setShared('dispatcher', fn() => $di->get(DispatcherInterface::class));
    }
}