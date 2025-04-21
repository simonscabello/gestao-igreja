<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:financial_categories,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'active' => ['required', 'boolean'],
        ];
    }
}
