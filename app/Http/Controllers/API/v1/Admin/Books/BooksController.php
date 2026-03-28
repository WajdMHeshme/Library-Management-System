<?php

namespace App\Http\Controllers\API\v1\Admin\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Books\StoreBookRequest;
use App\Http\Requests\API\v1\Books\UpdateBookRequest;
use App\Services\BookService;

class BooksController extends Controller
{
    public function __construct(
        private BookService $bookService
    ) {}

    public function index()
    {
        $availability = request()->query('availability');

        return response()->json(
            $this->bookService->filterBooksByAvailability($availability)
        );
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->bookService->createBook($request->validated());

        return response()->json($book, 201);
    }

    public function show($id)
    {
        return response()->json(
            $this->bookService->getBook($id)
        );
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->bookService->getBook($id);

        return response()->json(
            $this->bookService->updateBook($book, $request->validated())
        );
    }

    public function destroy($id)
    {
        $book = $this->bookService->getBook($id);

        $this->bookService->deleteBook($book);

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }
}
