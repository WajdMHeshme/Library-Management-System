<?php

namespace App\Repositories\Eloquent;

use App\Models\FAQ;
use App\Repositories\Contracts\FAQRepositoryInterface;

class FAQRepository implements FAQRepositoryInterface
{
    public function getAll()
    {
        return FAQ::all();
    }

    public function findById($id)
    {
        return FAQ::find($id);
    }

    public function create(array $data)
    {
        return FAQ::create($data);
    }

    public function update($faq, array $data)
    {
        $faq->update($data);
        return $faq;
    }

    public function delete($faq)
    {
        return $faq->delete();
    }
}
