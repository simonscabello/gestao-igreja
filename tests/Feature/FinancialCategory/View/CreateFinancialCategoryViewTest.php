<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('exibe o formulário de criação de categoria financeira', function () {
    $response = $this->get(route('categoryFinancial.create'));

    $response->assertOk();
    $response->assertSee('Adicionar Categoria');
    $response->assertSee('name="name"', false);
    $response->assertSee('name="active"', false);
    $response->assertSee('method="POST"', false);
    $response->assertSee('action="' . route('categoryFinancial.store') . '"', false);
});
