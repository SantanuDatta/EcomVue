<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\ProductSku;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'size_attribute_id' => ['nullable', 'exists:product_attributes,id'],
            'color_attribute_id' => ['nullable', 'exists:product_attributes,id'],
            'sku' => ['required', 'string', 'unique:product_skus', 'max:255'],
            'price' => ['required', 'integer'],
            'discount_price' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer'],
        ];
    }
}
