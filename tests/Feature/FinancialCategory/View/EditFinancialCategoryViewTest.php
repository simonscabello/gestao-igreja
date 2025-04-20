<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('exibe o formulário de edição com dados preenchidos', function () {
    $category = FinancialCategory::create([
        'name' => 'Categoria de Teste',
        'description' => 'Texto descritivo',
        'active' => true,
    ]);

    $response = $this->get(route('categoryFinancial.edit', ['categoryFinancial' => $category]));

    $response->assertOk();
    $response->assertSee('Editar Categoria: ' . $category->name);
    $response->assertSee('value="' . $category->name . '"', false);
//    $response->assertSee('Texto descritivo');
    $response->assertSee('action="' . route('categoryFinancial.update', $category) . '"', false);
    $response->assertSee('method="POST"', false); // Laravel usa spoof method para PUT
});
