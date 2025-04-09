<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\CartItem;

class UpdateCartItem
{
    /**
     * Create a new class UpdateCartItem.
     */
    public function handle(CartItem $cartItem, int $quantity): CartItem
    {
        $cartItem->update([
            'quantity' => $quantity,
        ]);

        return $cartItem;
    }
}
