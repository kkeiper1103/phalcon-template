<?php

namespace App\Middleware;

use App\Exceptions\TokenMismatchException;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

class CsrfTokenMiddleware implements MiddlewareInterface
{
    /**
     * @var array urls to exclude from CSRF protected
     */
    protected array $except = [

    ];

    #[\Override]
    public function handle(string $request, callable $next): ResponseInterface
    {
        // if the request is a POST request, validate the token
        if(strtoupper( $_SERVER['REQUEST_METHOD'] ) === "POST") {
            if(!in_array($request, $this->except)) {
                // check if csrf token matches
                $client_token = $_REQUEST['_csrf'] ?? null;
                $server_token = $_SESSION['_csrf'] ?? null;

                if(empty($client_token) || $server_token !== $client_token)
                    throw new TokenMismatchException();
            }
        }

        // otherwise, if there's no csrf token, generate one and add it to the session
        else if(strtoupper( $_SERVER['REQUEST_METHOD'] ) === "GET" && empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = $this->generateCsrfToken();
        }

        return $next($request);
    }

    protected function generateCsrfToken(): string {
        return bin2hex(random_bytes(32));
    }
}