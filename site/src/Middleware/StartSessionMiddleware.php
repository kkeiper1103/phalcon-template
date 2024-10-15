<?php

namespace App\Middleware;

use Phalcon\Http\ResponseInterface;

class StartSessionMiddleware implements MiddlewareInterface
{
    #[\Override]
    public function handle(string $request, callable $next): ResponseInterface
    {
        session_start();

        return $next($request);
    }
}