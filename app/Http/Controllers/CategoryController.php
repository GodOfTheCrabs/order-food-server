<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token');
        $data['image'] = $request->file('image')->store('categories', 'public');

        $category = Category::create($data);
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('edit', $category);

        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if($request->has('image')) {
            Storage::delete($category->image);
            $path = $request->file('image')->store('categories', 'public');

            $category->image = $path;
        }

        $category->update($request->except('_token', 'image'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $this->authorize('delete', $category);
        Storage::delete($category->image);

        $category->delete();
        return redirect()->route('categories.index');
    }
}
