<?php

declare(strict_types=1);

namespace App\Enums;

enum AddressType: string
{
    case SHIPPING = 'shipping';
    case BILLING = 'billing';
    case BOTH = 'both';

    /**
     * Get random enum value
     *
     * @return string
     */
    public static function randomValue(): string
    {
        $cases = self::cases();
        $key = array_rand($cases);

        return $cases[$key]->value;
    }

    /**
     * Get all enum values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::SHIPPING => 'Shipping Address',
            self::BILLING => 'Billing Address',
            self::BOTH => 'Shipping & Billing Address',
        };
    }
}
