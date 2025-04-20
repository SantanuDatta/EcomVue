<?php

declare(strict_types=1);

namespace App\Http\Resources\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read int $order_id
 * @property-read int $product_id
 * @property-read int $quantity
 * @property-read int $unit_price
 * @property-read Product $product
 */
class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'name' => $this->product->title,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
        ];
    }
}
