<?php

namespace App\Middleware;

use App\Auth\JwtAuth;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

class Authenticate
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$header = $this->getAuthorizationHeader($request)) {
            return $response->withStatus(401);
        }

        try {
            $a = $this->auth->authenticate($header);
        } catch (Exception $e) {
            return $response->withJson([
                'message' => $e->getMessage()
            ], 401);
        }

        return $next($request, $response);
    }

    protected function getAuthorizationHeader(Request $request)
    {
        if (!list($header) = $request->getHeader('Authorization', false)) {
            return false;
        }

        return $header;
    }
}
