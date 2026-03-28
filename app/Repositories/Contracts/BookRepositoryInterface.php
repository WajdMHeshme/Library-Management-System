<?php

namespace App\Repositories\Contracts;

use App\Models\Book;

interface BookRepositoryInterface
{
    public function all();
    public function find(int $id): Book;
    public function create(array $data): Book;
    public function update(Book $book, array $data): Book;
    public function delete(Book $book): bool;
    public function filterByAvailability(?string $type = null);
}
