<?php

return [
    'adapter'  => $_ENV['DB_DRIVER'],

    'host'     => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname'   => $_ENV['DB_NAME'],
    'charset'  => $_ENV['DB_CHARSET'] ?? 'utf8mb4'
];