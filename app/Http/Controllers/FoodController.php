<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search');

        $foods = Food::when($search, function ($query, $search) {
            return $query->where('info', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('foods.index', ['foods' => $foods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Food::class);

        $categories = Category::all();

        return view('foods.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodRequest $request)
    {
        $data = $request->except('_token');
        $data['image'] = $request->file('image')->store('foods', 'public');

        $food = Food::create($data);
        return redirect()->route('foods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food, User $user)
    {
        $this->authorize('view', $food);

        return view('foods.show', ['food' => $food,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        $this->authorize('edit', $food);

        $categories = Category::all();

        return view('foods.edit', ['food' => $food, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        if($request->has('image')) {

            Storage::delete($food->image);
            $path = $request->file('image')->store('images');

            $food->image = $path;
        }

        $food->update($request->except('_token', 'image'));

        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $this->authorize('delete', $food);
        Storage::delete($food->image);

        $food->delete();
        return redirect()->route('foods.index');
    }
}
