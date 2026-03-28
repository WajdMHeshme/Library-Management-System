<?php

namespace App\Http\Controllers\API\v1\Admin\FAQ;

use App\Http\Controllers\Controller;
use App\Services\FAQService;
use App\Http\Requests\API\v1\FAQ\StoreFAQRequest;
use App\Http\Requests\API\v1\FAQ\UpdateFAQRequest;

class FAQController extends Controller
{
    protected $faqService;

    public function __construct(FAQService $faqService)
    {
        $this->faqService = $faqService;
    }

    // عرض جميع الأسئلة
    public function index()
    {
        return response()->json(
            $this->faqService->getAllFAQs()
        );
    }

    // عرض سؤال معين
    public function show($id)
    {
        return response()->json(
            $this->faqService->getFAQById($id)
        );
    }

    // إضافة FAQ جديدة
    public function store(StoreFAQRequest $request)
    {
        return response()->json(
            $this->faqService->createFAQ($request->validated()),
            201
        );
    }

    // تحديث FAQ
    public function update(UpdateFAQRequest $request, $id)
    {
        return response()->json(
            $this->faqService->updateFAQ($id, $request->validated())
        );
    }

    // حذف FAQ
    public function destroy($id)
    {
        $this->faqService->deleteFAQ($id);

        return response()->json([
            'message' => 'FAQ deleted successfully'
        ]);
    }
}
