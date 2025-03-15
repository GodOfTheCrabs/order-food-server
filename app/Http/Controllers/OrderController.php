<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $orders = Order::when($search, function ($query, $search) {
            return $query->where('created_at', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $foodIds = collect($order->foods)->pluck('food_id');


        $foods = Food::whereIn('id', $foodIds)->get();

        foreach ($foods as $food) {
            $item = collect($order->foods)->firstWhere('food_id', $food->id);
            $food->count = $item['count']; 
        }
        return view('orders.show', ['order' => $order, 'foods' => $foods]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
