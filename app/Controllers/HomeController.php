<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->withJson(['works' => true]);
    }
}
