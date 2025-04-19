<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

class ProcessCartAction
{
    /**
     * @param  Authenticatable|null  $user
     * @return array<string, mixed>
     */
    public function execute($user, int $productId, int $quantity): array
    {
        if (! $user) {
            /** @var array<string, mixed> $cart */
            $cart = session()->get('cart', []);

            /** @var Product|null $product */
            $product = Product::find($productId);

            if (! $product) {
                throw new RuntimeException("Product ID {$productId} not found");
            }

            $cart['items'][$productId] = [
                'quantity' => $quantity,
                'price' => $product->price * 100,
            ];

            session()->put('cart', $cart);

            return $cart;
        }

        CartItem::updateOrCreate(
            ['user_id' => $user->getAuthIdentifier(), 'product_id' => $productId],
            ['quantity' => $quantity]
        );

        /** @var Collection<int, CartItem> $cartItems */
        $cartItems = $user->cartItems()->with('product')->get();

        return $cartItems->map(fn (CartItem $item): array => [
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price * 100,
        ])->toArray();
    }
}
