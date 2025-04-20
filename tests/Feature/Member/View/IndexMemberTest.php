<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enum\MemberGenderEnum;

uses(RefreshDatabase::class);

it('redireciona para login se não estiver autenticado', function () {
    $response = $this->get('/member');
    $response->assertRedirect('/login');
});

it('retorna a view correta com membros', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Member::factory()->create(['name' => 'João']);
    Member::factory()->create(['name' => 'Ana']);

    $response = $this->get('/member');

    $response->assertOk();
    $response->assertViewIs('members.index');
    $response->assertViewHas('members');
    $response->assertSeeText('João');
    $response->assertSeeText('Ana');
});

it('ordena os membros por nome corretamente', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Member::factory()->create(['name' => 'Zeca']);
    Member::factory()->create(['name' => 'Ana']);

    $response = $this->get('/member');

    $members = $response->viewData('members');

    expect($members->pluck('name')->toArray())->toBe(['Ana', 'Zeca']);
});

it('exibe mensagem ou layout mesmo sem membros cadastrados', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/member');

    $response->assertOk();
    $response->assertViewIs('members.index');
    $response->assertViewHas('members');
    $response->assertDontSeeText('Exception');
});

it('exibe informações chave dos membros na tela', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Member::factory()->create([
        'name' => 'Carlos Teste',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
    ]);

    $response = $this->get('/member');

    $response->assertSeeText('Carlos Teste');
    $response->assertSeeText('Masculino');
});

