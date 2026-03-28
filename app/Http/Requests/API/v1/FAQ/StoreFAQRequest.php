<?php


namespace App\Http\Requests\API\v1\FAQ;

use Illuminate\Foundation\Http\FormRequest;

class StoreFAQRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
        ];
    }
}
