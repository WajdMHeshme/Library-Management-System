<?php

// app/Http/Controllers/API/v1/Website/BorrowingController.php

namespace App\Http\Controllers\API\v1\Website\Borrowings;

use App\Http\Controllers\Controller;
use App\Services\BorrowingService;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function __construct(protected BorrowingService $service) {}

    public function store(Request $request)
    {
        $borrowing = $this->service->requestBorrow(
            auth()->id(),
            $request->book_id
        );

        return response()->json($borrowing);
    }

    public function myBorrowings()
    {
        return response()->json(
            $this->service->getUserBorrowings(auth()->id())
        );
    }
}
