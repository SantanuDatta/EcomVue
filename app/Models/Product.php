<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property-read int $int
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property-read bool $is_active
 */
class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'is_active',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany<ProductImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return HasMany<ProductAttribute, $this>
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return HasMany<Wishlist, $this>
     */
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    protected function casts()
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
