<?php

/**
 * @var \Phalcon\Mvc\Router $router
 */

$router->addPost("/contact", [
    \App\Controllers\ContactController::class,
    'indexAction',

    'controller' => 'contact',
    'action' => 'postIndex'
]);


$router->addGet('/posts', []);
$router->addGet('/posts/{slug}', []);
$router->addGet('/posts/create', []);
$router->addPost('/posts', []);
$router->addGet('/posts/{slug}/edit', []);
$router->addPost('/posts/{slug}', []);
$router->addPost('/posts/{slug}/destroy', []);


$router->addGet("/{slug}", [
    'controller' => \App\Controllers\PostController::class,
    'action' => 'showAction'
]);