<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\UploadedFile;

class CreateImage
{
    /**
     * @return array{
     *     image?: string,
     *     image_mime?: string,
     *     image_size?: int
     * }
     */
    public function handle(?UploadedFile $file): array
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
}
