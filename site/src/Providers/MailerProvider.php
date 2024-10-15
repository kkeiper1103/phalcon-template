<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class MailerProvider implements ServiceProviderInterface
{

    #[\Override]
    public function register(DiInterface $di): void
    {
        // TODO: Implement register() method.
    }
}