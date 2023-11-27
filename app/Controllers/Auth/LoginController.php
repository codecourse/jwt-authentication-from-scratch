<?php

namespace App\Controllers\Auth;

use App\Auth\JwtAuth;
use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class LoginController extends Controller
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request, Response $response)
    {
        if (!$token = $this->auth->attempt($request->getParam('email'), $request->getParam('password'))) {
            return $response->withStatus(401);
        }

        return $response->withJson([
            'token' => $token
        ]);
    }
}
