<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('ativa uma categoria financeira inativa', function () {
    $category = FinancialCategory::create([
        'name' => 'Campanha Reforma',
        'description' => 'Categoria de teste',
        'active' => false,
    ]);

    $response = $this->patch(route('categoryFinancial.activate', ['categoryFinancial' => $category]));

    $response->assertRedirect();
    $category->refresh();

    expect($category->active)->toBeTrue();
});
