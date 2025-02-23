<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class DeleteImage
{
    /**
     * Create a new class DeleteImage.
     */
    public function handle(?string $imagePath): void
    {
        if (is_string($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
