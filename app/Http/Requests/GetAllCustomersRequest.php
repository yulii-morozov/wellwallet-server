<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllCustomersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pageSize' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'sortField' => ['sometimes', Rule::in(['city', 'contacts'])],
            'sortOrder' => ['sometimes', Rule::in(['asc', 'desc'])],
        ];
    }

    public function messages(): array
    {
        return [
            'pageSize.integer' => 'The page size must be an integer.',
            'pageSize.min' => 'The page size must be at least 1.',
            'pageSize.max' => 'The page size may not be greater than 100.',
            'sortField.in' => 'The sort field must be either "city" or "contacts".',
            'sortOrder.in' => 'The sort order must be either "asc" or "desc".',
        ];
    }
}
