<?php

namespace App\Repositories\Contracts;

interface FAQRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($faq, array $data);
    public function delete($faq);
};
