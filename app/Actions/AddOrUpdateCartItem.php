<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\CartItem;

class AddOrUpdateCartItem
{
    /**
     * Create a new class AddOrUpdateCartItem.
     */
    public function handle(int $userId, int $productId, int $quantity): CartItem
    {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            $cartItem = CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return $cartItem;
    }
}
