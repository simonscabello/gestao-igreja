<?php


use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('cria uma categoria financeira com dados válidos', function () {
    $data = [
        'name' => 'Dízimo',
        'description' => 'Contribuição mensal',
        'active' => true,
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertRedirect();
    expect(FinancialCategory::count())->toBe(1)
        ->and(FinancialCategory::first())->toMatchArray([
            'name' => 'Dízimo',
            'description' => 'Contribuição mensal',
            'active' => true,
        ]);
});

it('valida que o campo nome é obrigatório', function () {
    $data = [
        'description' => 'Sem nome',
        'active' => true,
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertSessionHasErrors(['name']);
    expect(FinancialCategory::count())->toBe(0);
});

it('valida que o campo active é obrigatório', function () {
    $data = [
        'name' => 'Oferta',
        'description' => 'Sem active',
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertSessionHasErrors(['active']);
    expect(FinancialCategory::count())->toBe(0);
});

it('valida que active deve ser booleano', function () {
    $data = [
        'name' => 'Oferta',
        'description' => 'Valor inválido',
        'active' => 'talvez',
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertSessionHasErrors(['active']);
    expect(FinancialCategory::count())->toBe(0);
});

it('valida que name deve ter no máximo 255 caracteres', function () {
    $data = [
        'name' => str_repeat('a', 256),
        'description' => 'Nome muito longo',
        'active' => true,
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertSessionHasErrors(['name']);
});

it('permite criar sem descrição', function () {
    $data = [
        'name' => 'Campanha',
        'active' => true,
    ];

    $response = $this->post(route('categoryFinancial.store'), $data);

    $response->assertRedirect();
    expect(FinancialCategory::count())->toBe(1)
        ->and(FinancialCategory::first()->description)->toBeNull();
});
