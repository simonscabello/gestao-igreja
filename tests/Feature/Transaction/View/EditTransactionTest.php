<?php

use App\Models\User;
use App\Models\Transaction;

it('exibe a view de edição da transação', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $transaction = Transaction::factory()->create();

    $response = $this->get(route('transaction.edit', $transaction));

    $response->assertOk();
    $response->assertViewIs('transactions.edit');
    $response->assertViewHasAll(['transaction', 'financialCategories', 'types']);
});
