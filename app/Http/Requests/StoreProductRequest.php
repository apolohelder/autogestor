<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'is_active' => 'required|boolean',
            'brand_id' => 'required|exists:brands,id',
        ];
    }
}
