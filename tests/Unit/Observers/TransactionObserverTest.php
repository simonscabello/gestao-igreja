<?php

use App\Models\User;
use App\Models\Transaction;
use App\Models\FinancialCategory;
use App\Enum\TransactionTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('atribui o campo created_by automaticamente no creating', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = FinancialCategory::factory()->create();

    $transaction = Transaction::create([
        'financial_category_id' => $category->id,
        'amount' => 150.00,
        'type' => TransactionTypeEnum::INCOME,
        'action_date' => now(),
        'description' => 'Oferta de missões',
    ]);

    expect($transaction->created_by)->toBe($user->id);
});
