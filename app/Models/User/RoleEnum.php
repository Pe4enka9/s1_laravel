<?php

namespace App\Models\User;

enum RoleEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case OWNER = 'owner';
}
