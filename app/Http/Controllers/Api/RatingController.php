<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use Illuminate\Http\Request;
use Log;

class RatingController extends Controller
{
    public function store(RatingRequest $request)
    {
        $validated = $request->validated();

        $rating = Rating::create([
            'user_id' => $validated['user_id'],
            'food_id' => $validated['food_id'], 
            'rating' => $validated['rating'],  
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Заказ успешно создан!',
            'rating' => $rating,
        ], 201);
    }
}
