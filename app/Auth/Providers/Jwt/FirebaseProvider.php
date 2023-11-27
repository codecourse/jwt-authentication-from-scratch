<?php

namespace App\Auth\Providers\Jwt;

use App\Auth\Providers\Jwt\JwtProviderInterface;
use Firebase\JWT\JWT;
use Slim\Settings;

class FirebaseProvider implements JwtProviderInterface
{
    protected $settings;
    
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function encode(array $claims)
    {
        return JWT::encode($claims, $this->settings->get('jwt.secret'), 'HS256');
    }

    public function decode($token)
    {
        return JWT::decode($token, $this->settings->get('jwt.secret'), ['HS256']);
    }
}