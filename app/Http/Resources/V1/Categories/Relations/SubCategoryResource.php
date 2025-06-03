<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Categories\Relations;

use App\Http\Resources\V1\Categories\IndexResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SubCategory
 */
class SubCategoryResource extends JsonResource
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
            'category' => $this->whenLoaded('category', fn (): ?IndexResource => $this->category ? new IndexResource($this->category) : null),
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $this->image_url,
        ];
    }
}
