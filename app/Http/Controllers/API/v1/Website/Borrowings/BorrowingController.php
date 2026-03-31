<?php

// app/Http/Controllers/API/v1/Website/BorrowingController.php

namespace App\Http\Controllers\API\v1\Website\Borrowings;

use App\DTOs\Borrowing\CreateBorrowingDTO;
use App\Http\Controllers\Controller;
use App\Services\BorrowingService;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function __construct(protected BorrowingService $service) {}



    public function store(Request $request)
    {
        $dto = CreateBorrowingDTO::fromRequest($request, auth()->id());

        return response()->json(
            $this->service->requestBorrow($dto)
        );
    }

    public function myBorrowings()
    {
        return response()->json(
            $this->service->getUserBorrowings(auth()->id())
        );
    }
}
