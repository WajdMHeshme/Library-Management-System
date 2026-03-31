<?php

namespace App\Services;

use App\DTOs\Borrowing\CreateBorrowingDTO;
use App\Enums\BorrowingStatus;
use App\Exceptions\ApiException;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BorrowingService
{
    public function __construct(
        protected BorrowingRepositoryInterface $repository
    ) {}

    public function getAll(?string $status = null)
    {
        if ($status) {
            return $this->repository->getByStatus($status);
        }

        return $this->repository->getAll();
    }

    public function approve(int $id)
    {
        return DB::transaction(function () use ($id) {

            $borrowing = $this->repository->findById($id);

            if ($borrowing->status !== BorrowingStatus::PENDING->value) {
                throw new ApiException('Borrowing already processed');
            }

            if (!$borrowing->book || $borrowing->book->stock <= 0) {
                throw new ApiException('Book not available');
            }

            $borrowing->book->decrement('stock');

            return $this->repository->updateStatus($id, [
                'status' => BorrowingStatus::APPROVED->value,
                'borrowed_at' => now(),
                'due_date' => now()->addDays(7),
            ]);
        });
    }

    public function reject(int $id)
    {
        $borrowing = $this->repository->findById($id);

        if ($borrowing->status !== BorrowingStatus::PENDING->value) {
            throw new ApiException('Cannot reject this borrowing');
        }

        return $this->repository->updateStatus($id, [
            'status' => BorrowingStatus::REJECTED->value,
        ]);
    }

    public function returnBook(int $id)
    {
        return DB::transaction(function () use ($id) {

            $borrowing = $this->repository->findById($id);

            if ($borrowing->status !== BorrowingStatus::APPROVED->value) {
                throw new ApiException('Cannot return this book');
            }

            $borrowing->book->increment('stock');

            return $this->repository->updateStatus($id, [
                'status' => BorrowingStatus::RETURNED->value,
                'returned_at' => now(),
            ]);
        });
    }

    public function getPending()
    {
        return $this->repository->getPending();
    }

    public function getUserBorrowings(int $userId)
    {
        return $this->repository->getUserBorrowings($userId);
    }

public function requestBorrow(CreateBorrowingDTO $dto)
{
    $borrowing = $this->repository->getUserBorrowings($dto->userId)
        ->where('book_id', $dto->bookId)
        ->whereIn('status', $dto->duplicateStatuses())
        ->first();

    if ($borrowing) {
        throw new ApiException('You already requested this book');
    }

    return $this->repository->create($dto->toArray());
}
}
