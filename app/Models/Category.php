<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property-read int $id
 * @property string $name
 * @property string $slug
 * @property string|null $image_url
 * @property string|null $label
 */
class Category extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'label',
    ];

    /**
     * @return HasMany<SubCategory, $this>
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
