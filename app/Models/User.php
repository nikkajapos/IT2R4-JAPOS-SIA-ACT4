<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements JWTSubject
{
    use Authenticatable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'gender'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

