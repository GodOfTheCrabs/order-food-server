<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'foods' => $validated['foods'], 
            'total_price' => $validated['total_price'],  
            'track_order' => $validated['track_order'],  
            'preparation_time' => $validated['preparation_time'],  
            'delivery_time' => $validated['delivery_time'],  
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Заказ успешно создан!',
        ], 201);
    }
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc') 
            ->take(4) 
            ->get();
     
        return new OrderCollection($orders);
    }
}
