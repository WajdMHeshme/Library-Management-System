<?php



namespace App\Http\Controllers\API\v1\Admin\Borrowing;

use App\Http\Controllers\Controller;
use App\Services\BorrowingService;

class BorrowingController extends Controller
{
    public function __construct(protected BorrowingService $service) {}

    public function pending()
    {
        return response()->json($this->service->getPending());
    }

    public function approve($id)
    {
        return response()->json($this->service->approve($id));
    }

    public function reject($id)
    {
        return response()->json($this->service->reject($id));
    }

    public function returnBook($id)
    {
        return response()->json($this->service->returnBook($id));
    }
}
