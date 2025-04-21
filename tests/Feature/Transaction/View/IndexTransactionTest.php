<?php

use App\Models\User;
use App\Models\Transaction;

it('exibe a listagem de transações', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Transaction::factory()->count(3)->create();

    $response = $this->get(route('transaction.index'));

    $response->assertOk();
    $response->assertViewIs('transactions.index');
    $response->assertViewHas('transactions');
});
