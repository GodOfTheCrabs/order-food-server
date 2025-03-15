<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
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
            'info' => 'required|min:10|max:255',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price_unit_id' => 'required|exists:price_units,id',
            'image' => 'nullable|max:4096'
        ];
    }
}
