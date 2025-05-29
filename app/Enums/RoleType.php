<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleType: int
{
    case ADMIN = 1;
    case CUSTOMER = 2;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::CUSTOMER => 'Customer'
        };
    }
}
