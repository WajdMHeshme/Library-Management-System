<?php

namespace App\Services;

use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewService
{
    public function __construct(
        private ReviewRepositoryInterface $reviewRepository
    ) {}

    public function createReview(array $data)
    {
        return $this->reviewRepository->create($data);
    }

    public function getPendingReviews()
    {
        return $this->reviewRepository->getByStatus('pending');
    }

    public function getByStatus(string $status)
    {
        return $this->reviewRepository->getByStatus($status);
    }

    public function getApprovedReviewsByBook(int $bookId)
    {
        return $this->reviewRepository->getApprovedByBook($bookId);
    }

    public function approve(int $id)
    {
        return $this->reviewRepository->updateStatus($id, 'approved');
    }

    public function reject(int $id)
    {
        return $this->reviewRepository->updateStatus($id, 'rejected');
    }

    public function delete(int $id)
    {
        return $this->reviewRepository->delete($id);
                return response()->json([
            'message' => 'Review deleted'
        ]);
    }
}
