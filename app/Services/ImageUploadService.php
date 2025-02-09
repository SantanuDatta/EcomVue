<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageUploadService
{
    /**
     * Create a new class ImageUploadService.
     */
    public function handleProductImage(?UploadedFile $file): array
    {
        if (!$file instanceof \Illuminate\Http\UploadedFile) {
            return [];
        }

        return [
            'image' => $file->store('products', 'public'),
            'image_mime' => $file->getClientMimeType(),
            'image_size' => $file->getSize(),
        ];
    }
}
