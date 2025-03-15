<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Log;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        Log::info('Запрос на создание комментария', ['user' => auth()->user(), 'data' => $request->all()]);

        $validated = $request->validated();

        $сomment = Comment::create([
            'user_id' => $validated['user_id'],
            'food_id' => $validated['food_id'], 
            'comment' => $validated['comment'],  
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Коментар успешно создан!',
        ], 201);
    }
}
