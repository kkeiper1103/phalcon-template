<?php

namespace App\Middleware;

use Phalcon\Http\ResponseInterface;
use Phalcon\Session\Manager;

class StartSessionMiddleware implements MiddlewareInterface
{
    public function __construct(
        protected Manager $session
    ) {}

    #[\Override]
    public function handle(string $request, callable $next): ResponseInterface
    {
        $this->session->start();

        return $next($request);
    }
}