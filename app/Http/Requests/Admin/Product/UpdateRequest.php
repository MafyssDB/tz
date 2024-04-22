<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'price' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'discount' => 'nullable|integer',
            'own_products' => 'nullable|integer',
            'image' => 'nullable|file',
            'popular' => 'required|integer',
        ];
    }
}
