<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', 
            'foods' => 'required|array',           
            'foods.*.food_id' => 'required|exists:foods,id', 
            'foods.*.count' => 'required|integer|min:1',     
            'total_price' => 'required|numeric|min:0',  
            'preparation_time' => 'required|integer ',
            'delivery_time' => 'required|integer',    
            'track_order' => 'required|boolean',      
        ];
    }
}
