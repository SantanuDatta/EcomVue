<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Products;

use App\Http\Resources\V1\Categories\IndexResource as CategoryResource;
use App\Http\Resources\V1\Products\Relations\AttributeResource;
use App\Http\Resources\V1\Products\Relations\ImageResource;
use App\Http\Resources\V1\Products\Relations\SkuResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class IndexResource extends JsonResource
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
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'is_active' => $this->is_active,
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'skus' => SkuResource::collection($this->whenLoaded('skus')),
            'published_at' => $this->published_at,
        ];
    }
}
