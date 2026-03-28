<?php

namespace App\Repositories\Contracts;

interface BorrowingRepositoryInterface
{
    public function getAll();

    public function getByStatus(string $status);

    public function create(array $data);

    public function findById(int $id);

    public function updateStatus(int $id, array $data);

    public function getPending();

    public function getUserBorrowings(int $userId);
}
