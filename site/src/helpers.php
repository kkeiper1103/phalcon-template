<?php

namespace App;


use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

function csrf_token(): string {
    return "<input type='hidden' name='_csrf' id='_csrf' value='{$_SESSION['_csrf']}' />";
}


function redirect(string $location, int $status = 302): ResponseInterface {
    $redirect = new Response(null, $status);

    $redirect->setHeader("Location", $location);

    return $redirect;
}


function old(string $key, string $default = null): string {
    return $_POST[$key] ?? $default;
}