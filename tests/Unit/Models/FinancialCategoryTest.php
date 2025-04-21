<?php

use App\Models\User;
use App\Models\FinancialCategory;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('cria uma categoria financeira com sucesso', function () {
    $category = FinancialCategory::create([
        'name' => 'Ofertas',
        'description' => 'Categoria de ofertas',
        'active' => true,
    ]);

    expect($category)->toBeInstanceOf(FinancialCategory::class)
        ->and($category->name)->toBe('Ofertas')
        ->and($category->description)->toBe('Categoria de ofertas')
        ->and($category->active)->toBeTrue();
});

it('faz cast de active para boolean corretamente', function () {
    $category = FinancialCategory::create([
        'name' => 'Campanhas',
        'description' => null,
        'active' => 1, // valor numérico
    ]);

    expect($category->active)->toBeTrue();
});

it('relacionamento com transactions funciona', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $category = FinancialCategory::factory()->create();

    Transaction::factory()->count(2)->create([
        'financial_category_id' => $category->id,
    ]);

    expect($category->transactions)->toHaveCount(2)
        ->and($category->transactions->first())->toBeInstanceOf(Transaction::class);
});

it('impede mass assignment de campos não fillable', function () {
    $category = FinancialCategory::create([
        'name' => 'Dízimos',
        'description' => 'Dízimos mensais',
        'active' => true,
        'hacked_field' => 'XSS', // campo inexistente
    ]);

    expect(isset($category->hacked_field))->toBeFalse();
});
