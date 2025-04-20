<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('atualiza uma categoria financeira com dados válidos', function () {
    $category = FinancialCategory::create([
        'name' => 'Oferta',
        'description' => 'Oferta comum',
        'active' => true,
    ]);

    $data = [
        'name' => 'Oferta Atualizada',
        'description' => 'Descrição atualizada',
        'active' => false,
    ];

    $response = $this->put(route('categoryFinancial.update', $category), $data);

    $response->assertRedirect();
    $category->refresh();

    expect($category->name)->toBe('Oferta Atualizada')
        ->and($category->description)->toBe('Descrição atualizada')
        ->and($category->active)->toBeFalse();
});

it('valida que o campo name é obrigatório na atualização', function () {
    $category = FinancialCategory::create([
        'name' => 'Oferta',
        'description' => 'Desc',
        'active' => true,
    ]);

    $data = [
        'name' => '',
        'description' => 'Desc',
        'active' => true,
    ];

    $response = $this->put(route('categoryFinancial.update', $category), $data);

    $response->assertSessionHasErrors(['name']);
});

it('valida que active deve ser booleano na atualização', function () {
    $category = FinancialCategory::create([
        'name' => 'Oferta',
        'description' => 'Desc',
        'active' => true,
    ]);

    $data = [
        'name' => 'Nova',
        'description' => 'Desc',
        'active' => 'talvez',
    ];

    $response = $this->put(route('categoryFinancial.update', $category), $data);

    $response->assertSessionHasErrors(['active']);
});

it('permite atualizar sem descrição', function () {
    $category = FinancialCategory::create([
        'name' => 'Campanha',
        'description' => 'Texto antigo',
        'active' => true,
    ]);

    $data = [
        'name' => 'Campanha Atualizada',
        'description' => null,
        'active' => true,
    ];

    $response = $this->put(route('categoryFinancial.update', $category), $data);

    $response->assertRedirectToRoute('categoryFinancial.show', $category);
    $category->refresh();

    expect($category->description)->toBeNull();
});

