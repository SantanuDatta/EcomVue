<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    /**
     * @param  array{items: array<string, array{price: int|float, quantity: int}>}  $cart
     * @param  array<string, mixed>  $details
     */
    public function execute(?User $user, array $cart, array $details): Order
    {
        return DB::transaction(function () use ($user, $cart, $details) {
            /** @var int|float $totalPrice */
            $totalPrice = collect($cart['items'])->sum(fn (array $item): int|float => $item['price'] * $item['quantity']);

            /** @var Order $order */
            $order = Order::create([
                'user_id' => $user instanceof User ? $user->id : null,
                'guest_token' => $user instanceof User ? null : bin2hex(random_bytes(16)),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $order->details()->create($details);

            foreach ($cart['items'] as $productId => $item) {
                /** @var array{price: int|float, quantity: int} $item */
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            $user?->cartItems()->delete();
            session()->forget('cart');

            /** @var Order */
            return $order->load('items', 'details');
        });
    }
}
