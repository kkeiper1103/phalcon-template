<?php

/**
 * @var \Phalcon\Mvc\Router $router
 */

use Phalcon\Mvc\Router;

$router->addGet("contact", [
    'controller' => \App\Controllers\ContactController::class,
    'action' => 'create'
]);
$router->addPost("contact", [
    'controller' => \App\Controllers\ContactController::class,
    'action' => 'store'
]);

//
$posts = new Router\Group([
    'controller' => \App\Controllers\PostController::class
]);
$posts->setPrefix('/posts');
$posts->add('/', ['action' => 'index']);
$posts->add('/{id}', ['action' => 'show']);
$posts->add('/create', ['action' => 'create']);
$posts->addPost('/', ['action' => 'store']);
$posts->add('/{id}/edit', [ 'action' => 'edit']);
$posts->addPost('/{id}', ['action' => 'update']);
$posts->addPost('/{id}/destroy', ['action' => 'destroy']);
$router->mount($posts);

$router->addGet("{slug}", [
    'controller' => \App\Controllers\PostController::class,
    'action' => 'show'
]);

$router->addGet('/', [
    'controller' => \App\Controllers\IndexController::class,
    'action' => 'index'
]);
