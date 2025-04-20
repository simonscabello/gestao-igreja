<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enum\MemberGenderEnum;

uses(RefreshDatabase::class);

it('redireciona para login se não estiver autenticado', function () {
    $member = Member::factory()->create();

    $response = $this->get("/member/{$member->id}/edit");

    $response->assertRedirect('/login');
});

it('exibe a view de edição com os dados do membro autenticado', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = Member::factory()->create([
        'name' => 'Carlos Editado',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
    ]);

    $response = $this->get("/member/{$member->id}/edit");

    $response->assertOk();
    $response->assertViewIs('members.edit');
    $response->assertViewHas('member');

    $response->assertSee('Carlos Editado');
    $response->assertSee('27999999999');
});

it('retorna 404 se o membro não existir', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get("/member/999999/edit");

    $response->assertNotFound();
});
