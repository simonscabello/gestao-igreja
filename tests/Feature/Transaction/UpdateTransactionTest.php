<?php

use App\Models\User;
use App\Models\Transaction;
use App\Models\FinancialCategory;
use App\Enum\TransactionTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);

    $this->category = FinancialCategory::factory()->create();
    $this->transaction = Transaction::factory()->create([
        'financial_category_id' => $this->category->id,
        'created_by' => $this->user->id,
    ]);
});

it('atualiza uma transação válida', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => 555.55,
        'type' => TransactionTypeEnum::EXPENSE->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Atualizada com sucesso',
    ];

    $response = $this->put(route('transaction.update', $this->transaction), $data);

    $response->assertRedirect(route('transaction.index'));

    $this->transaction->refresh();

    expect($this->transaction->description)->toBe('Atualizada com sucesso');
});

it('retorna erro se campos obrigatórios estiverem ausentes na edição', function () {
    $response = $this->put(route('transaction.update', $this->transaction), []);

    $response->assertSessionHasErrors([
        'description',
        'amount',
        'action_date',
        'financial_category_id',
        'type',
    ]);
});

it ('retorna erro se transação não existir', function () {
    $response = $this->put(route('transaction.update', 123));

    $response->assertNotFound();
    $response->assertSessionDoesntHaveErrors();
});

it('retorna erro se o valor for negativo na edição', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => -10,
        'type' => TransactionTypeEnum::EXPENSE->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Valor inválido',
    ];

    $response = $this->put(route('transaction.update', $this->transaction), $data);

    $response->assertSessionHasErrors(['amount']);
});

it('retorna erro se o tipo for inválido na edição', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => 100,
        'type' => 'errado',
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Tipo inválido',
    ];

    $response = $this->put(route('transaction.update', $this->transaction), $data);

    $response->assertSessionHasErrors(['type']);
});

it('retorna erro se categoria financeira não existir na edição', function () {
    $data = [
        'financial_category_id' => 9999,
        'amount' => 100,
        'type' => TransactionTypeEnum::INCOME->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Categoria inexistente',
    ];

    $response = $this->put(route('transaction.update', $this->transaction), $data);

    $response->assertSessionHasErrors(['financial_category_id']);
});
