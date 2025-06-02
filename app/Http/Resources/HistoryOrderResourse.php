<?php

namespace App\Http\Resources;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryOrderResourse extends JsonResource
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
                'count' => $food['count']
            ];
        });
        return [
            'id' => $this->id,
            'date' => $this->created_at?->format('Y-m-d'),
            'foods' => $foods,
            'price' => $this->total_price,
        ];
    }
}
