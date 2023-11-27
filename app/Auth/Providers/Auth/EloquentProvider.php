<?php

namespace App\Auth\Providers\Auth;

use App\Auth\Providers\Auth\AuthServiceProvider;
use App\Models\User;

class EloquentProvider implements AuthServiceProvider
{
    public function byCredentials($username, $password)
    {
        if (!$user = User::where('email', $username)->first()) {
            return null;
        }

        if (!password_verify($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function byId($id)
    {
        return User::find($id);
    }
}