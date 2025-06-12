<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $userId = auth()->user()->id;

        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $userId,
            'phone' => 'nullable|string|unique:users,phone,' . $userId,
            'gender' => 'nullable|string|in:male,female',
            'photo' => 'nullable',
            'daily_limit' => 'nullable|integer',
            'monthly_limit' => 'nullable|integer',
            'age' => 'nullable|integer',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'is_manage_finances' => 'nullable|boolean',
            'is_feed' => 'nullable|boolean'
        ];
    }
}
