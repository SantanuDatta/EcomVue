<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $customer_id
 * @property-read string $type
 * @property-read string $address1
 * @property-read string|null $address2
 * @property-read string $city
 * @property-read string|null $state
 * @property-read string $zip_code
 * @property-read string $country_code
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 * @property-read Customer|null $customer
 * @property-read Country|null $country
 * @property-read Customer $customer
 * @property-read Country $country
 */
class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'type',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'country_code',
    ];

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<Country, $this>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    protected function casts(): array
    {
        return [
            'customer_id' => 'integer',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }
}
