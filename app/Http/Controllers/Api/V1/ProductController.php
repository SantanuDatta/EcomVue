<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Product\ProductListResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductListResource::collection(Product::query()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageUploadService $imageUploadService): ProductResource
    {
        $validated = $request->validated();
        $imageData = $imageUploadService->handleProductImage(
            $request->file('image')
        );
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
    public function update(ProductRequest $request, Product $product, ImageUploadService $imageUploadService): ProductResource
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imageData = $imageUploadService->handleProductImage($request->file('image'));
            $validated = array_merge($validated, $imageData);
        }

        $product->update($validated);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ImageUploadService $imageUploadService)
    {
        if ($product->image) {
            $imageUploadService->deleteProductImage($product->image);
        }

        $product->forceDelete();

        return response()->noContent();
    }
}
