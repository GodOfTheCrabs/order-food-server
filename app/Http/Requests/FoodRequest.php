<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|max:4096',
            'recipe' => 'nullable'
        ];

    }

    public function messages() {
        return [
            'name.required' => "Це поле обов'язкове для заповнення"
        ];
    }
}
