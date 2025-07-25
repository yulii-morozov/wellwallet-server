<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CreateCustomerRequestRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'type' => ['required', Rule::in(array_column(\App\Enums\OrderType::cases(), 'value'))],
            'source' => ['required', Rule::in(array_column(\App\Enums\OrderSource::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(\App\Enums\OrderStatus::cases(), 'value'))],
        ];
    }
}