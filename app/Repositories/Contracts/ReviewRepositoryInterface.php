<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface
{
    public function create(array $data);
    public function getApprovedByBook(int $bookId);
    public function getByStatus(string $status);
    public function findById(int $id);
    public function updateStatus(int $id, string $status);
    public function delete(int $id);
}
