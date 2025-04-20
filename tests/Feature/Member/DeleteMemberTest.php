<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deleta um membro com sucesso e preenche campos via observer', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = Member::factory()->create();

    $this->delete("/member/{$member->id}")
        ->assertRedirectToRoute('member.index');

    $deleted = Member::withTrashed()->find($member->id);

    expect($deleted->deleted_at)->not->toBeNull()
        ->and($deleted->dismissed_date)->not->toBeNull()
        ->and($deleted->deleted_by)->toBe($user->id);
});

it('não permite deletar sem estar autenticado', function () {
    $member = Member::factory()->create();

    $this->delete("/member/{$member->id}")
        ->assertRedirect('/login');

    expect(Member::count())->toBe(1);
});

it('retorna 404 ao tentar deletar membro inexistente', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->delete("/member/99999")->assertNotFound();
});

