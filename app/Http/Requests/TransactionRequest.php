<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enum\TransactionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
            'financial_category_id' => ['required', 'exists:financial_categories,id'],
            'type' => ['required', Rule::enum(TransactionTypeEnum::class)],
        ];
    }
}
