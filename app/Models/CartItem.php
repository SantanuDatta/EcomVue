<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $quantity
 */
class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_sku_id',
        'quantity',
    ];

    /**
     * @return BelongsTo<Cart, $this>
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo<ProductSku, $this>
     */
    public function productSku(): BelongsTo
    {
        return $this->belongsTo(ProductSku::class);
    }
}
