<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Handle the product image upload.
     *
     * @param  UploadedFile|null  $file  The uploaded file.
     * @return array<string, string|int|null> Returns an associative array with the following keys:
     *                                        - 'image': The path to the stored image (string).
     *                                        - 'image_mime': The MIME type of the image (string).
     *                                        - 'image_size': The size of the image in bytes (int).
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
