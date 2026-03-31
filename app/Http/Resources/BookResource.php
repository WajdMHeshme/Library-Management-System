<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'price' => (float) $this->price,
            'stock' => $this->stock,
            'language' => $this->language,
            'published_year' => $this->published_year,
            'pages' => $this->pages,
            'availability' => $this->availability,

            'cover_image' => $this->cover_image
                ? asset('storage/' . $this->cover_image)
                : null,
            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],
            'average_rating' => $this->reviews->count()
                ? round($this->reviews->avg('rating'), 1)
                : null,

            'reviews_count' => $this->reviews->count(),
            'reviews' => $this->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'created_at' => $review->created_at,

                    'user' => [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                    ],
                ];
            }),

            'created_at' => $this->created_at,
        ];
    }
}
