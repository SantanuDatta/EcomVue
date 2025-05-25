<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $type
 * @property string $value
 */
class ProductAttribute extends Model
{
    protected $fillable = [
        'type',
        'value',
    ];

    /**
     * @return HasMany<ProductSku, $this>
     */
    public function productSkus(): HasMany
    {
        return $this->hasMany(ProductSku::class);
    }
}
