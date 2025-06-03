<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Products\Relations;

use App\Models\ProductSku;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductSku
 */
class SkuResource extends JsonResource
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
            'sku' => $this->sku,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'quantity' => $this->quantity,
            'size' => new AttributeResource($this->whenLoaded('sizeAttribute')),
            'color' => new AttributeResource($this->whenLoaded('colorAttribute')),
        ];
    }
}
