<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Url;

class UrlProvider implements ServiceProviderInterface
{

    #[\Override]
    public function register(DiInterface $di): void
    {
        $di->set(Url::class, function() {
            $url = new Url();
            $url->setBasePath('/');

            return $url;
        });

        $di->set('url', fn() => $di->get(Url::class));
    }
}