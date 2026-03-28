<?php

namespace App\Services;


use App\Repositories\Contracts\FAQRepositoryInterface;

class FAQService
{
    protected $faqRepository;

    public function __construct(FAQRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getAllFAQs()
    {
        return $this->faqRepository->getAll();
    }

    public function getFAQById($id)
    {
        return $this->faqRepository->findById($id);
    }

    public function createFAQ(array $data)
    {
        return $this->faqRepository->create($data);
    }

    public function updateFAQ($faq, array $data)
    {
        return $this->faqRepository->update($faq, $data);
    }

    public function deleteFAQ($faq)
    {
        return $this->faqRepository->delete($faq);
    }
}
