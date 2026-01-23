<?php

namespace App\Services;

use App\Models\User\User;

class AuthService
{
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function generateRandomPassword($length = 10)
    {
        return bin2hex(random_bytes($length / 2));
    }
}
