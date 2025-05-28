<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentProvider: string
{
    case Stripe = 'stripe';
    case PayPal = 'paypal';
    case COD = 'cash_on_delivery';

    public function label(): string
    {
        return match ($this) {
            self::Stripe => 'Stripe',
            self::PayPal => 'PayPal',
            self::COD => 'Cash on Delivery',
        };
    }
}
