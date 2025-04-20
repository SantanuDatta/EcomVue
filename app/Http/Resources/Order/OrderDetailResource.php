<?php

declare(strict_types=1);

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read int $order_id
 * @property-read string $first_name
 * @property-read string $last_name
 * @property-read string $email
 * @property-read string|null $phone
 * @property-read string $address1
 * @property-read string|null $address2
 * @property-read string $city
 * @property-read string|null $state
 * @property-read string $zip_code
 * @property-read string $country_code
 */
class OrderDetailResource extends JsonResource
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
            'order_id' => $this->order_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country_code' => $this->country_code,
        ];
    }
}
