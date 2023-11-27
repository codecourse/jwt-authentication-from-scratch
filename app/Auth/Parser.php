<?php

namespace App\Auth;

use App\Auth\Providers\Jwt\JwtProviderInterface;

class Parser
{
    protected $jwtProvider;

    public function __construct(JwtProviderInterface $jwtProvider)
    {
        $this->jwtProvider = $jwtProvider;
    }

    public function decode($token)
    {
        return $this->jwtProvider->decode(
            $this->extractToken($token)
        );
    }

    protected function extractToken($token)
    {
        if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            return $matches[1];
        }

        return null;
    }
}