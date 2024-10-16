<?php

namespace App\Middleware;

use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;

class MiddlewareStack
{
    public function __construct(
        protected Application $application
    ) {
        // if an application is being passed to a middlewarestack, it can't send headers immediately. gotta unwrap it
        $application->sendHeadersOnHandleRequest(false);
        $application->sendCookiesOnHandleRequest(false);
    }

    protected $middlewares = [];

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(string $request): \Phalcon\Http\Response
    {
        $next = function (string $request) {


            // Base case, if no middleware remains, this function is called.
            $response = $this->application->handle($request);


            // var_dump($request, $this->application->di->get(Router::class)); exit;

            return $response;
        };

        // Loop over the middlewares in reverse order to chain them properly
        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function ($request) use ($middleware, $next) {
                return $middleware->handle($request, $next);
            };
        }

        // Start the middleware chain
        return $next($request);
    }
}