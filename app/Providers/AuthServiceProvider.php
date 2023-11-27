<?php

namespace App\Providers;

use App\Auth\ClaimsFactory;
use App\Auth\Factory;
use App\Auth\JwtAuth;
use App\Auth\Parser;
use App\Auth\Providers\Auth\EloquentProvider;
use App\Auth\Providers\Jwt\FirebaseProvider;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        JwtAuth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(JwtAuth::class, function () use ($container) {
            $authProvider = new EloquentProvider();

            $claimsFactory = new ClaimsFactory(
                $container->get('request'),
                $container->get('settings')
            );

            $jwtProvider = new FirebaseProvider($container->get('settings'));

            $factory = new Factory($claimsFactory, $jwtProvider);

            $parser = new Parser($jwtProvider);

            return new JwtAuth($authProvider, $factory, $parser);
        });
    }
}