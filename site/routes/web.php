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


$router->addGet("/{slug:(.*)}", [
    'controller' => \App\Controllers\PostController::class,
    'action' => 'show'
]);

/**
 * show case how to use a route group
 */
$posts = new Router\Group([
    'controller' => \App\Controllers\PostController::class
]);
$posts->setPrefix('/posts');

// add all of the resourceful routes
$posts->addGet('/', ['action' => 'index']);
$posts->addGet('/create', ['action' => 'create']);
$posts->addPost('/', ['action' => 'store']);
$posts->addGet('/{id:([\d]+)}', ['action' => 'show']);
$posts->addGet('/{id:([\d]+)}/edit', [ 'action' => 'edit']);
$posts->addPost('/{id:([\d]+)}', ['action' => 'update']);
$posts->addPost('/{id:([\d]+)}/destroy', ['action' => 'destroy']);

// finally, mount the group of routes into the router
$router->mount($posts);


$router->addGet('/', [
    'controller' => \App\Controllers\IndexController::class,
    'action' => 'index'
]);