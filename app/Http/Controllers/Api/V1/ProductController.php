<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateImage;
use App\Actions\DeleteImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Product\ProductListResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection<ProductListResource>
     */
    public function index(): ResourceCollection
    {
        return ProductListResource::collection(Product::query()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, CreateImage $createImage): ProductResource
    {
        $validated = $request->validated();
        /** @var array{image?: string, image_mime?: string, image_size?: int} $imageData */
        $imageData = $createImage->handle($request->file('image'));
        $product = Product::create(array_merge($validated, $imageData));

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, CreateImage $createImage,
        DeleteImage $deleteImage): ProductResource
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $deleteImage->handle($product->image);
            /** @var array{image?: string, image_mime?: string, image_size?: int} $imageData */
            $imageData = $createImage->handle($request->file('image'));
            $validated = array_merge($validated, $imageData);
        }

        $product->update($validated);

        return new ProductResource($product->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, DeleteImage $deleteImage): Response
    {
        $deleteImage->handle($product->image);
        $product->forceDelete();

        return response()->noContent();
    }
}
