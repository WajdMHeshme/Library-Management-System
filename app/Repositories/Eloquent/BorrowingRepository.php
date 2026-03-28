<?php

namespace App\Repositories\Eloquent;

use App\Models\Borrowing;
use App\Repositories\Contracts\BorrowingRepositoryInterface;

class BorrowingRepository implements BorrowingRepositoryInterface
{

    public function getAll()
    {
        return Borrowing::all();
    }

    public function getByStatus(string $status)
    {
        return Borrowing::with(['user', 'book'])
            ->where('status', $status)
            ->latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Borrowing::create($data);
    }

    public function findById(int $id)
    {
        return Borrowing::with(['user', 'book'])->findOrFail($id);
    }

    public function updateStatus(int $id, array $data)
    {
        $borrowing = $this->findById($id);
        $borrowing->update($data);

        return $borrowing->fresh(['user', 'book']);
    }

    public function getPending()
    {
        return Borrowing::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    public function getUserBorrowings(int $userId)
    {
        return Borrowing::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }
}
