<?php

use App\Models\User;
use App\Models\FinancialCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('exibe a lista com categorias ativas e inativas, ordenadas por nome', function () {
    $c1 = FinancialCategory::create(['name' => 'Z - Última', 'description' => null, 'active' => false]);
    $c2 = FinancialCategory::create(['name' => 'A - Primeira', 'description' => null, 'active' => true]);

    $response = $this->get(route('categoryFinancial.index'));

    $response->assertOk();
    $response->assertSeeInOrder(['A - Primeira', 'Z - Última']);
    $response->assertSeeText('Z - Última');
    $response->assertSeeText('A - Primeira');
//    $response->assertSeeText('Desativar');
//    $response->assertSeeText('Ativar');
    $response->assertSee(route('categoryFinancial.edit', $c1));
});
