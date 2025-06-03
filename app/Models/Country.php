<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $code
 * @property string $name
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get the customer addresses for the country.
     *
     * @return HasMany<CustomerAddress, $this>
     */
    public function customers(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
