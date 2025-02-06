<?php

declare(strict_types=1);

namespace App\Actions;

use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class CreateProduct
{
    public function __invoke(ProductRequest $request): ProductResource
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('products', 'public');
            $data['image_mime'] = $file->getClientMimeType();
            $data['image_size'] = $file->getSize();
        }

        return new ProductResource(Product::create($data));
    }
}
