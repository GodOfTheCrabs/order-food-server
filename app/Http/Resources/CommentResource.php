<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'author' => $this->user?->first_name ?? 'Невідомий',
            'comment' => $this->comment,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
