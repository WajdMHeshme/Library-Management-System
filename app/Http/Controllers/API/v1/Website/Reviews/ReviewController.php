<?php

namespace App\Http\Controllers\API\v1\Website\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Reviews\StoreReviewRequest;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(
        private ReviewService $service
    ) {}

    public function store(StoreReviewRequest $request, int $book_id)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['book_id'] = $book_id;

        return $this->service->createReview($data);
    }

    public function index(int $book_id)
    {
        return $this->service->getApprovedReviewsByBook($book_id);
    }
}
