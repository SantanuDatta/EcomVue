<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = IndexResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'links' => ['self' => url()->current()],
            'meta' => ['count' => $this->count()],
        ];
    }
}
