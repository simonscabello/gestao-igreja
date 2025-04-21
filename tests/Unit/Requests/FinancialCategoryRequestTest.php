<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FinancialCategoryRequest;

function validateCategory(array $data): \Illuminate\Validation\Validator
{
    $request = new FinancialCategoryRequest();
    return Validator::make($data, $request->rules());
}

it('valida uma categoria financeira válida', function () {
    $data = [
        'name' => 'Missões',
        'description' => 'Categoria para ofertas missionárias',
        'active' => true,
    ];

    $validator = validateCategory($data);

    expect($validator->fails())->toBeFalse();
});

it('falha se nome estiver ausente', function () {
    $validator = validateCategory([
        'active' => true,
    ]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('falha se active não for boolean', function () {
    $validator = validateCategory([
        'name' => 'Ofertas',
        'active' => 'sim', // inválido
    ]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('active'))->toBeTrue();
});

it('falha se descrição for muito longa', function () {
    $longDescription = str_repeat('a', 256); // 256 caracteres
    $validator = validateCategory([
        'name' => 'Ofertas',
        'description' => $longDescription,
        'active' => true,
    ]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue();
});

it('falha se nome já existir', function () {
    // Simulando que o nome "Ofertas" já existe no banco de dados
    $existingCategory = \App\Models\FinancialCategory::factory()->create(['name' => 'Ofertas']);

    $validator = validateCategory([
        'name' => 'Ofertas',
        'description' => 'Outra descrição',
        'active' => true,
    ]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});
