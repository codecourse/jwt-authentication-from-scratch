<?php

namespace App\Models;

use App\Auth\Contracts\JwtSubject;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements JwtSubject
{
    protected $hidden = [
        'password'
    ];

    public function getJwtIdentifier()
    {
        return $this->id;
    }
}
