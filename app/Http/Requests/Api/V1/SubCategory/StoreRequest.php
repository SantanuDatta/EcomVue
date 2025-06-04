<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\SubCategory;

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
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'label' => ['nullable', 'string', 'max:255'],
        ];
    }
}
