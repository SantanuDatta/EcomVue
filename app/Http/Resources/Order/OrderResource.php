<?php

declare(strict_types=1);

namespace App\Http\Resources\Order;

use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read int $total_price
 * @property-read string $status
 * @property-read Collection<OrderItem> $items
 * @property-read OrderDetail $details
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price / 100,
            'status' => $this->status,
            'items' => OrderItemResource::collection($this->items),
            'shipping' => new OrderDetailResource($this->details),
        ];
    }
}
