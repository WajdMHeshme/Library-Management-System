<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'book_id' => $this->book_id,
            'book_title' => $this->book->title,
            'book_cover' => $this->book->cover_image,
            'book_category' => $this->book->category?->name,
            'book_author' => $this->book->author,
            'created_at' => $this->created_at,
        ];
    }
}
