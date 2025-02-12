<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Create a new class ImageUploadService.
     */
    public function handleProductImage(?UploadedFile $file): array
    {
        if (! $file instanceof UploadedFile) {
            return [];
        }

        return [
            'image' => $file->store('products', 'public'),
            'image_mime' => $file->getClientMimeType(),
            'image_size' => $file->getSize(),
        ];
    }

    /**
     * Delete product image if it exists.
     */
    public function deleteProductImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
