<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersAnalyticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_spent' => round($this['total_spent'], 2),
            'categories' => collect($this['categories'])->map(function ($item) {
                return [
                    'category' => $item['category'],
                    'sum' => round($item['sum'], 2),
                    'percent' => round($item['percent'], 2),
                ];
            })->values(),
            'max' => round($this['max'], 2),
            'min' => round($this['min'], 2),
            'average' => round($this['average'], 2),
        ];
    }
}
