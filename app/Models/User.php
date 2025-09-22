<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $phone_number
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens;

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];
}
