<?php

namespace App\Enums;

enum UserRoles: int
{
    case ADMIN = 1;

    case USER = 0;

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'admin',
            self::USER => 'user',
        };
    }
}
