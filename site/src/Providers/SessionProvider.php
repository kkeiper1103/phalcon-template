<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Html\Escaper;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Session\Manager;

class SessionProvider implements ServiceProviderInterface
{
    #[\Override]
    public function register(DiInterface $di): void
    {
        $di->set('session', function() {
            $session = new Manager();
            $storage = new Stream([
                'savePath' => BASE_PATH . '/storage/tmp'
            ]);

            $session->setAdapter($storage);

            return $session;
        });

        $di->set('flashSession', function() use(&$di) {
            $flash = new FlashSession(new Escaper(), $di->get('session'));

            $flash->setCssClasses([
                'error'   => 'alert bg-danger text-white fw-bold',
                'success' => 'alert bg-success text-white fw-bold',
                'notice'  => 'alert bg-info fw-bold',
                'warning' => 'alert bg-warning fw-bold',
            ]);

            return $flash;
        });
    }
}