<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category->name,
            'recipe' => $this->recipe,
            'image' => asset('storage/' . $this->image),
            'comments' => CommentResource::collection($this->comments),
            'rating' => round($this->ratings->pluck('rating')->avg(), 1)
        ];
    }
}
