<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\CartItem;

class DeleteCartItem
{
    /**
     * Create a new class DeleteCartItem.
     */
    public function handle(CartItem $cartItem): void
    {
        $cartItem->delete();
    }
}
