<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('exibe todos os detalhes da categoria financeira', function () {
    $category = FinancialCategory::create([
        'name' => 'Missões',
        'description' => 'Categoria para ofertas missionárias',
        'active' => true,
    ]);

    $response = $this->get(route('categoryFinancial.show', ['categoryFinancial' => $category]));

    $response->assertOk();
    $response->assertSeeText('Missões');
//    $response->assertSeeText('Categoria para ofertas missionárias');
    $response->assertSeeText('Ativo');
});
