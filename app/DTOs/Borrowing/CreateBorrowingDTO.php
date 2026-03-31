<?php

namespace App\DTOs\Borrowing;

use App\Enums\BorrowingStatus;

class CreateBorrowingDTO
{
    public function __construct(
        public int $userId,
        public int $bookId,
    ) {}

    public static function fromRequest($request, int $userId): self
    {
        return new self(
            userId: $userId,
            bookId: $request->book_id
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'book_id' => $this->bookId,
            'status'  => BorrowingStatus::PENDING->value,
        ];
    }

    public function duplicateStatuses(): array
    {
        return [
            BorrowingStatus::PENDING->value,
            BorrowingStatus::APPROVED->value,
        ];
    }
}
