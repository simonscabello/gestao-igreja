<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('desativa uma categoria financeira ativa', function () {
    $category = FinancialCategory::create([
        'name' => 'Ofertas Especiais',
        'description' => 'Categoria ativa',
        'active' => true,
    ]);

    $response = $this->patch(route('categoryFinancial.deactivate', ['categoryFinancial' => $category]));

    $response->assertRedirect();
    $category->refresh();

    expect($category->active)->toBeFalse();
});
