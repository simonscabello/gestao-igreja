<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enum\MemberGenderEnum;

uses(RefreshDatabase::class);

it('redireciona para login se não estiver autenticado', function () {
    $member = Member::factory()->create();

    $response = $this->get("/member/{$member->id}");

    $response->assertRedirect('/login');
});

it('exibe a view com os detalhes do membro autenticado', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = Member::factory()->create([
        'name' => 'João Detalhado',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
    ]);

    $response = $this->get("/member/{$member->id}");

    $response->assertOk();
    $response->assertViewIs('members.show');
    $response->assertViewHas('member');

    $response->assertSeeText('João Detalhado');
    $response->assertSeeText('27999999999');
    $response->assertSeeText('Masculino'); // se estiver usando label()
});

it('retorna 404 se o membro não existir', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get("/member/999999");

    $response->assertNotFound();
});
