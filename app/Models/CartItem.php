<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $quantity
 * @property-read CarbonImmutable|null $created_at
 * @property-read CarbonImmutable|null $updated_at
 * @property-read Cart $cart
 * @property-read Product $product
 * @property-read ProductSku $productSku
 */
class CartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_sku_id',
        'quantity',
    ];

    /**
     * Get the cart that owns the cart item.
     *
     * @return BelongsTo<Cart, $this>
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the product that owns the cart item.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product sku that owns the cart item.
     *
     * @return BelongsTo<ProductSku, $this>
     */
    public function productSku(): BelongsTo
    {
        return $this->belongsTo(ProductSku::class);
    }
}
