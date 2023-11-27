<?php

namespace App\Auth;

use App\Auth\Providers\Jwt\JwtProviderInterface;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Slim\Settings;

class Factory
{
    protected $claims;

    protected $claimsFactory;

    protected $jwtProvider;

    public function __construct(ClaimsFactory $claimsFactory, JwtProviderInterface $jwtProvider)
    {
        $this->claimsFactory = $claimsFactory;
        $this->jwtProvider = $jwtProvider;
    }

    public function withClaims(array $claims)
    {
        $this->claims = $claims;

        return $this;
    }

    public function make()
    {
        $claims = [];

        foreach ($this->getDefaltClaims() as $claim) {
            $claims[$claim] = $this->claimsFactory->get($claim);
        }

        return array_merge($this->claims, $claims);
    }

    protected function getDefaltClaims()
    {
        return $this->claimsFactory->getDefaltClaims();
    }

    public function encode(array $claims)
    {
        return $this->jwtProvider->encode($claims);
    }
}
