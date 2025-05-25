<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $order_id
 * @property-read Order $order
 * @property int $amount
 * @property string $provider
 * @property string $status
 */
class PaymentDetail extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'provider',
        'status',
    ];

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
