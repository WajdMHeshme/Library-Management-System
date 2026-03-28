<?php

// app/Http/Requests/API/v1/Borrowing/StoreBorrowingRequest.php

namespace App\Http\Requests\API\v1\Borrowing;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'book_id' => ['required', 'exists:books,id'],
        ];
    }
}
