<?php

use App\Models\User;
use App\Models\FinancialCategory;
use App\Models\Transaction;
use App\Enum\TransactionTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);

    $this->category = FinancialCategory::factory()->create();
});

it('cria uma transação válida e redireciona para a tela de detalhes', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => 199.90,
        'type' => TransactionTypeEnum::INCOME->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Oferta de gratidão',
    ];

    $response = $this->post(route('transaction.store'), $data);

    $transaction = Transaction::latest()->first();

    $response->assertRedirect(route('transaction.show', $transaction));
    expect($transaction->created_by)->toBe($this->user->id);
});

it('retorna erro se algum campo obrigatório estiver ausente', function () {
    $response = $this->post(route('transaction.store'), []);

    $response->assertSessionHasErrors([
        'description',
        'amount',
        'action_date',
        'financial_category_id',
        'type',
    ]);
});

it('retorna erro se o valor for negativo', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => -10,
        'type' => TransactionTypeEnum::EXPENSE->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Valor inválido',
    ];

    $response = $this->post(route('transaction.store'), $data);

    $response->assertSessionHasErrors(['amount']);
});

it('retorna erro se o tipo for inválido', function () {
    $data = [
        'financial_category_id' => $this->category->id,
        'amount' => 100,
        'type' => 'errado',
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Tipo inválido',
    ];

    $response = $this->post(route('transaction.store'), $data);

    $response->assertSessionHasErrors(['type']);
});

it('retorna erro se categoria financeira não existir', function () {
    $data = [
        'financial_category_id' => 9999,
        'amount' => 100,
        'type' => TransactionTypeEnum::INCOME->value,
        'action_date' => now()->format('Y-m-d H:i:s'),
        'description' => 'Categoria inexistente',
    ];

    $response = $this->post(route('transaction.store'), $data);

    $response->assertSessionHasErrors(['financial_category_id']);
});
