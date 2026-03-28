<?php


namespace App\Services;

use App\Repositories\Contracts\BorrowingRepositoryInterface;
use Carbon\Carbon;

class BorrowingService
{
    public function __construct(
        protected BorrowingRepositoryInterface $repository
    ) {}

    public function requestBorrow(int $userId, int $bookId)
    {
        return $this->repository->create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'status'  => 'pending',
        ]);
    }

    public function approve(int $id)
    {
        return $this->repository->updateStatus($id, [
            'status' => 'approved',
            'borrowed_at' => now(),
            'due_date' => Carbon::now()->addDays(7),
        ]);
    }

    public function reject(int $id)
    {
        return $this->repository->updateStatus($id, [
            'status' => 'rejected',
        ]);
    }

    public function returnBook(int $id)
    {
        return $this->repository->updateStatus($id, [
            'status' => 'returned',
            'returned_at' => now(),
        ]);
    }

    public function getPending()
    {
        return $this->repository->getPending();
    }

    public function getUserBorrowings(int $userId)
    {
        return $this->repository->getUserBorrowings($userId);
    }
}
