<?php

declare(strict_types=1);

namespace App\Http\Resources\CartItem;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read ProductResource $product
 * @property-read int $quantity
 */
class CartItemResource extends JsonResource
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
            'product_id' => new ProductResource($this->whenLoaded('product')),
            'quantity' => $this->quantity,
        ];
    }
}
