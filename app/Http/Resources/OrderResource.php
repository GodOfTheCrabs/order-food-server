<?php

namespace App\Http\Resources;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $foods = collect($this->foods)->map(function  ($food) {
            $foodItem = Food::find($food['food_id']);
            return [
                'id' => $foodItem->id,
                'name' => $foodItem->name,
                'price' => $foodItem->price,
                'category' => $foodItem->category->name,
                'recipe' => $foodItem->recipe,
                'image' => asset('storage/' . $foodItem->image),
                'comments' => CommentResource::collection($foodItem->comments),
                'rating' => round($foodItem->ratings->pluck('rating')->avg(), 1),
                'count' => $foodItem['count']
            ];
        });

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'foods' => $foods
        ];
    }
}
