<?php

use App\Auth\JwtAuth;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\MeController;
use App\Controllers\HomeController;
use App\Middleware\Authenticate;

$app->get('/', HomeController::class . ':index');

$app->post('/auth/login', LoginController::class . ':index');

$app->get('/me', MeController::class . ':index')->add(new Authenticate($container->get(JwtAuth::class)));
