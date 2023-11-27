<?php

namespace App\Auth;

use Carbon\Carbon;
use Psr\Http\Message\RequestInterface;
use Slim\Settings;

class ClaimsFactory
{
    protected $defaultClaims = [
        'iss',
        'iat',
        'exp',
        'nbf',
        'jti'
    ];

    protected $request;

    protected $settings;

    public function __construct(RequestInterface $request, Settings $settings)
    {
        $this->request = $request;
        $this->settings = $settings;
    }

    public function getDefaltClaims()
    {
        return $this->defaultClaims;
    }

    public function iss()
    {
        return $this->request->getUri()->getPath();
    }

    public function iat()
    {
        return Carbon::now()->getTimestamp();
    }

    public function nbf()
    {
        return Carbon::now()->getTimestamp();
    }

    public function jti()
    {
        return bin2hex(str_random(32));
    }

    public function exp()
    {
        return Carbon::now()->addMinutes($this->settings->get('jwt.expiry'))->getTimestamp();
    }

    public function get($claim)
    {
        if (!method_exists($this, $claim)) {
            return null;
        }

        return $this->{$claim}();
    }
}