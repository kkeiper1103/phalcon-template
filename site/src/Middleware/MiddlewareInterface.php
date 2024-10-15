<?php

namespace App\Middleware;

use Phalcon\Http\ResponseInterface;

interface MiddlewareInterface {
    public function handle(string $request, callable $next): ResponseInterface;
}