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
$posts->addGet('/', ['action' => 'index']);
$posts->addGet('/{id:([0-9]+)}', ['action' => 'show']);
$posts->addGet('/create', ['action' => 'create']);
$posts->addPost('/', ['action' => 'store']);
$posts->addGet('/{id:([0-9]+)}/edit', [ 'action' => 'edit']);
$posts->addPost('/{id:([0-9]+)}', ['action' => 'update']);
$posts->addPost('/{id:([0-9]+)}/destroy', ['action' => 'destroy']);
$router->mount($posts);

$router->addGet("{slug}", [
    'controller' => \App\Controllers\PostController::class,
    'action' => 'show'
]);

$router->addGet('/', [
    'controller' => \App\Controllers\IndexController::class,
    'action' => 'index'
]);

// var_dump($router->getRoutes()); exit;