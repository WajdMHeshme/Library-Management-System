<?php

// app/Repositories/Eloquent/BorrowingRepository.php

namespace App\Repositories\Eloquent;

use App\Models\Borrowing;
use App\Repositories\Contracts\BorrowingRepositoryInterface;

class BorrowingRepository implements BorrowingRepositoryInterface
{
    public function create(array $data)
    {
        return Borrowing::create($data);
    }

    public function findById(int $id)
    {
        return Borrowing::findOrFail($id);
    }

    public function updateStatus(int $id, array $data)
    {
        $borrowing = $this->findById($id);
        $borrowing->update($data);
        return $borrowing;
    }

    public function getPending()
    {
        return Borrowing::where('status', 'pending')->with(['user', 'book'])->get();
    }

    public function getUserBorrowings(int $userId)
    {
        return Borrowing::where('user_id', $userId)->with('book')->get();
    }
}
