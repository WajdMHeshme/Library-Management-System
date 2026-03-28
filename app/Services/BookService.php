<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Http\UploadedFile;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ApiException;

class BookService
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {}

    /**
     * Get all books with their category
     */
    public function getAllBooks()
    {
        try {
            return $this->bookRepository->all(); // already loads category
        } catch (\Throwable $e) {
            throw new ApiException("Failed to fetch books: " . $e->getMessage());
        }
    }

    /**
     * Get single book by ID
     */
    public function getBook(int $id): Book
    {
        try {
            $book = $this->bookRepository->find($id);

            if (!$book) {
                throw new ResourceNotFoundException("Book");
            }

            return $book; // already loads category
        } catch (ResourceNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw new ApiException("Failed to fetch book: " . $e->getMessage());
        }
    }

    /**
     * Create a new book
     */
    public function createBook(array $data): Book
    {
        try {
            // Handle cover image
            if (isset($data['cover_image']) && $data['cover_image'] instanceof UploadedFile) {
                $data['cover_image'] = $data['cover_image']->store('books', 'public');
            }

            // Ensure category_id and availability are in $data
            $data['category_id'] = $data['category_id'] ?? null;
            $data['availability'] = $data['availability'] ?? 'sale'; // default

            // Create book
            $book = $this->bookRepository->create($data);

            return $book->load('category');

        } catch (\Throwable $e) {
            throw new ApiException("Failed to create book: " . $e->getMessage());
        }
    }

    /**
     * Update existing book
     */
    public function updateBook(Book $book, array $data): Book
    {
        try {
            // Handle cover image
            if (isset($data['cover_image']) && $data['cover_image'] instanceof UploadedFile) {
                $data['cover_image'] = $data['cover_image']->store('books', 'public');
            }

            // Update category_id and availability if provided
            if (isset($data['category_id'])) {
                $book->category_id = $data['category_id'];
            }
            if (isset($data['availability'])) {
                $book->availability = $data['availability'];
            }

            // Remove from $data to avoid double update
            unset($data['category_id'], $data['availability']);

            $book = $this->bookRepository->update($book, $data);

            return $book->load('category');

        } catch (\Throwable $e) {
            throw new ApiException("Failed to update book: " . $e->getMessage());
        }
    }

    /**
     * Delete a book
     */
    public function deleteBook(Book $book): bool
    {
        try {
            return $this->bookRepository->delete($book);
        } catch (\Throwable $e) {
            throw new ApiException("Failed to delete book: " . $e->getMessage());
        }
    }

    /**
     * Filter books by availability: sale, rent, borrow
     */
    public function filterBooksByAvailability(?string $type = null)
    {
        try {
            return $this->bookRepository->filterByAvailability($type);
        } catch (\Throwable $e) {
            throw new ApiException("Failed to filter books: " . $e->getMessage());
        }
    }
}
