<?php

namespace App\Controllers\Auth;

use App\Auth\JwtAuth;
use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class MeController extends Controller
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request, Response $response)
    {
        return $response->withJson($this->auth->user());
    }
}
