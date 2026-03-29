<?php

namespace App\Http\Controllers\API\v1\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(
        private ReviewService $service
    ) {}

    public function pending()
    {
        return $this->service->getPendingReviews();
    }

    public function approved()
    {
        return $this->service->getByStatus('approved');
    }

    public function rejected()
    {
        return $this->service->getByStatus('rejected');
    }

    public function approve($id)
    {
        return $this->service->approve($id);
    }

    public function reject($id)
    {
        return $this->service->reject($id);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
