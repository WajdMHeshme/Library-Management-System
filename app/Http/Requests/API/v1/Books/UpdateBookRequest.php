<?php

namespace App\Http\Requests\API\v1\Books;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'numeric', 'min:0'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'cover_image' => ['sometimes', 'nullable', 'image', 'max:2048'],
            'language' => ['sometimes', 'nullable', 'string', 'max:50'],
            'published_year' => ['sometimes', 'nullable', 'integer'],
            'pages' => ['sometimes', 'nullable', 'integer'],
            'availability' => ['sometimes', 'string', 'in:sale,rent,borrow'],
        ];
    }
}
