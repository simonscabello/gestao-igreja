<?php

use App\Enum\TransactionTypeEnum;
use App\Http\Requests\TransactionRequest;
use App\Models\FinancialCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function validateTransaction(array $data): \Illuminate\Validation\Validator {
    $request = new TransactionRequest();
    return Validator::make($data, $request->rules());
}

it('valida com sucesso os dados corretos', function () {
    $category = FinancialCategory::factory()->create();

    $data = [
        'description' => 'Pagamento da luz',
        'amount' => 150.50,
        'action_date' => now()->format('Y-m-d'),
        'financial_category_id' => $category->id,
        'type' => TransactionTypeEnum::EXPENSE->value,
    ];

    $validator = validateTransaction($data);

    expect($validator->fails())->toBeFalse();
});

it('falha se campos obrigatórios estiverem ausentes', function () {
    $validator = validateTransaction([]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->keys())->toContain(
            'description', 'amount', 'action_date', 'financial_category_id', 'type'
        );
});

it('falha se valor for negativo', function () {
    $category = FinancialCategory::factory()->create();

    $data = [
        'description' => 'Algo inválido',
        'amount' => -10,
        'action_date' => now()->format('Y-m-d'),
        'financial_category_id' => $category->id,
        'type' => TransactionTypeEnum::INCOME->value,
    ];

    $validator = validateTransaction($data);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue();
});

it('falha se o tipo for inválido', function () {
    $category = FinancialCategory::factory()->create();

    $data = [
        'description' => 'Algo inválido',
        'amount' => 100,
        'action_date' => now()->format('Y-m-d'),
        'financial_category_id' => $category->id,
        'type' => 'errado',
    ];

    $validator = validateTransaction($data);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('type'))->toBeTrue();
});

it('falha se a categoria não existir', function () {
    $data = [
        'description' => 'Teste',
        'amount' => 50,
        'action_date' => now()->format('Y-m-d'),
        'financial_category_id' => 9999, // inexistente
        'type' => TransactionTypeEnum::INCOME->value,
    ];

    $validator = validateTransaction($data);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('financial_category_id'))->toBeTrue();
});
