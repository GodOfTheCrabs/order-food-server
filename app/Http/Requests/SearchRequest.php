<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'created_at' => 'nullable|string',
            'created_at_from' => 'nullable|string',
            'created_at_to' => 'nullable|string',
            'per_page' => 'nullable|integer|in:10,25,50',
            'report_type' => 'nullable|string|',
        ];
    }
}
