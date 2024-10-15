<?php

namespace App\Providers;

use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Db\Adapter\PdoFactory;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DatabaseProvider implements ServiceProviderInterface
{

    #[\Override]
    public function register(DiInterface $di): void
    {
        $di->setShared(AdapterInterface::class, function() {
            $config = [
                'host'     => $_ENV['DB_HOST'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'dbname'   => $_ENV['DB_NAME'],
            ];

            return new Mysql($config);
        });

        $di->setShared('db', fn() => $di->get(AdapterInterface::class));
    }
}