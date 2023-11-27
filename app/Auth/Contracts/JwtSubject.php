<?php

namespace App\Auth\Contracts;

interface JwtSubject
{
    public function getJwtIdentifier();
}