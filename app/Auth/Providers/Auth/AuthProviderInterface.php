<?php

namespace App\Auth\Providers\Auth;

interface AuthServiceProvider
{
    public function byCredentials($username, $password);
    public function byId($id);
}
