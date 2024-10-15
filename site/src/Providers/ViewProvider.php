<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;

class ViewProvider implements ServiceProviderInterface
{

    #[\Override]
    public function register(DiInterface $di): void
    {
        $di->set(View::class, function() {
            $view = new View();
            $view->setViewsDir(BASE_PATH . '/resources/views/');
            $view->setLayout("layout");

            return $view;
        });

        $di->set('view', fn() => $di->get(View::class));
    }
}