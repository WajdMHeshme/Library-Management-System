<?php

namespace App\Http\Requests\API\v1\FAQ;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFAQRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => 'sometimes|string|max:255',
            'answer'   => 'sometimes|string',
        ];
    }
}
