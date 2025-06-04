<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Users\Relations;

use App\Http\Resources\V1\Users\IndexResource;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CustomerAddress
 */
class CustomerAddressResource extends JsonResource
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
            'user' => $this->when(
                $this->relationLoaded('user') && $this->user_id !== null,
                fn (): IndexResource => new IndexResource($this->user)
            ),
            'type' => [
                'label' => $this->type->label(),
            ],
            'address_one' => $this->address_one,
            'address_two' => $this->address_two,
            'country_code' => $this->country_code,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ];
    }
}
