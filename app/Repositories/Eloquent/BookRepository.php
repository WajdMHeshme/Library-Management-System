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
        return Book::with('category')->findOrFail($id);
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

    // دالة الفلترة حسب النوع
    public function filterByAvailability(?string $type = null)
    {
        $query = Book::with('category');

        if ($type) {
            // sale, rent, borrow
            $query->where('availability', $type);
        }

        return $query->get();
    }
}
