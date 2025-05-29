<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $product_id
 * @property int|null $size_attribute_id
 * @property int|null $color_attribute_id
 * @property string $sku
 * @property int $price
 * @property int|null $discount_price
 * @property int $quantity
 * @property-read CarbonImmutable|null $created_at
 * @property-read CarbonImmutable|null $updated_at
 * @property-read ProductAttribute|null $colorAttribute
 * @property-read Product $product
 * @property-read ProductAttribute|null $sizeAttribute
 */
class ProductSku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'size_attribute_id',
        'color_attribute_id',
        'sku',
        'price',
        'discount_price',
        'quantity',
    ];

    /**
     * Get the product that owns the product sku.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the size attribute that owns the product sku.
     *
     * @return BelongsTo<ProductAttribute, $this>
     */
    public function sizeAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'size_attribute_id');
    }

    /**
     * Get the color attribute that owns the product sku.
     *
     * @return BelongsTo<ProductAttribute, $this>
     */
    public function colorAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'color_attribute_id');
    }
}
