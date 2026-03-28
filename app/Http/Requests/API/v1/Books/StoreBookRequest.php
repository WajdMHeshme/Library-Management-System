<?php

namespace App\Http\Requests\API\v1\Books;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],

            'category_id' => ['nullable', 'exists:categories,id'],

            'cover_image' => ['nullable', 'image', 'max:2048'],

            'language' => ['nullable', 'string', 'max:50'],
            'published_year' => ['nullable', 'integer'],
            'pages' => ['nullable', 'integer'],
            'availability' => ['nullable', 'string', 'in:sale,borrow'],
        ];
    }
}
