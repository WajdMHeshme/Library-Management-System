<?php

namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function create(array $data)
    {
        return Review::create($data);
    }

    public function getByStatus(string $status)
    {
        return Review::with(['user', 'book'])
            ->where('status', $status)
            ->latest()
            ->paginate(10);
    }

    public function findById(int $id)
    {
        return Review::findOrFail($id);
    }

    public function updateStatus(int $id, string $status)
    {
        $review = $this->findById($id);
        $review->update(['status' => $status]);

        return $review;
    }

    public function delete(int $id)
    {
        return Review::destroy($id);
    }

    public function getApprovedByBook(int $bookId)
{
    return Review::with(['user'])
        ->where('book_id', $bookId)
        ->where('status', 'approved')
        ->latest()
        ->get();
}
}
