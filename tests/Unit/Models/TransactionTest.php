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
});

it('cria uma transação com sucesso', function () {
    $user = User::factory()->create();
    $category = FinancialCategory::factory()->create();

    $transaction = Transaction::create([
        'financial_category_id' => $category->id,
        'amount' => 500.75,
        'type' => TransactionTypeEnum::INCOME,
        'action_date' => now(),
        'description' => 'Dízimo especial',
        'created_by' => $user->id,
    ]);

    expect($transaction)
        ->toBeInstanceOf(Transaction::class)
        ->and($transaction->amount)->toBe(500.75);
});

it('relaciona corretamente com categoria financeira', function () {
    $transaction = Transaction::factory()->create();

    expect($transaction->category)->toBeInstanceOf(FinancialCategory::class);
});

it('relaciona corretamente com o criador', function () {
    $transaction = Transaction::factory()->create();

    expect($transaction->createdBy)->toBeInstanceOf(User::class);
});

it('cast de tipo funciona com enum', function () {
    $transaction = Transaction::factory()->create([
        'type' => TransactionTypeEnum::EXPENSE,
    ]);

    expect($transaction->type)
        ->toBe(TransactionTypeEnum::EXPENSE)
        ->and($transaction->type)
        ->toBeInstanceOf(TransactionTypeEnum::class);
});

it('cast de data funciona como Carbon', function () {
    $transaction = Transaction::factory()->create([
        'action_date' => now()->subDays(1),
    ]);

    expect($transaction->action_date)->toBeInstanceOf(\Carbon\Carbon::class);
});

it('impede mass assignment de campos não fillable', function () {
    $user = User::factory()->create();

    $transaction = Transaction::create([
        'financial_category_id' => FinancialCategory::factory()->create()->id,
        'amount' => 100,
        'type' => TransactionTypeEnum::EXPENSE,
        'action_date' => now(),
        'description' => 'Oferta',
        'created_by' => $user->id,
        'hacked_field' => 'malicioso', // não está em $fillable
    ]);

    expect(isset($transaction->hacked_field))->toBeFalse();
});
