<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $code
 * @property-read string $name
 * @property-read array<array{name: string, code?: string}>|null $states
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
class Country extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'states',
    ];

    public function setCodeAttribute(string $value): void
    {
        $this->attributes['code'] = mb_strtoupper($value);
    }

    protected function casts(): array
    {
        return [
            'states' => 'array',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }
}
