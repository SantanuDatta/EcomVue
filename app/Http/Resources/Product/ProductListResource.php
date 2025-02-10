<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property-read int $id
 * @property-read string $title
 * @property-read string $image
 * @property-read int $price
 * @property-read \Illuminate\Support\Carbon $updated_at
 */
class ProductListResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image ? Storage::url($this->image) : null,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
        ];
    }
}
