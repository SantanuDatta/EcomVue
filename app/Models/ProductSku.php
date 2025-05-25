<?php

declare(strict_types=1);

namespace App\Models;

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
 */
class ProductSku extends Model
{
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
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo<ProductAttribute, $this>
     */
    public function sizeAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'size_attribute_id');
    }

    /**
     * @return BelongsTo<ProductAttribute, $this>
     */
    public function colorAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'color_attribute_id');
    }
}
