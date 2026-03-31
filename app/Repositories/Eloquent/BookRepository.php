<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::with('category')->get();
    }

    public function find(int $id): Book
    {
        return Book::with([
            'category',
            'reviews' => function ($q) {
                $q->where('status', 'approved')->latest();
            },
            'reviews.user'
        ])->findOrFail($id);
    }

    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        return $book->fresh()->load('category');
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }


    public function filterByAvailability(?string $type = null)
    {
        $query = Book::with('category');

        if ($type) {
            $query->where('availability', $type);
        }

        return $query->get();
    }

    public function getByFilters(array $filters)
    {
        return Book::with('category')
            ->when($filters['category_id'] ?? null, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($filters['availability'] ?? null, function ($q, $availability) {
                $q->where('availability', $availability);
            })
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('title', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);
    }
}
