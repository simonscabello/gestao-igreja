<?php

use App\Models\User;
use App\Models\Member;
use App\Models\Address;
use App\Enum\MemberGenderEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('cria um membro com sucesso', function () {
    $member = Member::create([
        'name' => 'João Unitário',
        'birth_date' => '1990-05-15',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE,
    ]);

    expect($member)->toBeInstanceOf(Member::class)
        ->and($member->name)->toBe('João Unitário');
});

it('tem relacionamento hasOne com address', function () {
    $member = Member::factory()->create();

    $member->address()->create([
        'street' => 'Rua Teste',
        'number' => '100',
        'neighborhood' => 'Centro',
        'city' => 'Cidade',
        'state' => 'ES',
        'zipcode' => '29000-000',
    ]);

    expect($member->address)->toBeInstanceOf(Address::class)
        ->and($member->address->street)->toBe('Rua Teste');
});

it('formata birth_date corretamente', function () {
    $member = Member::create([
        'name' => 'Fulano',
        'birth_date' => '2000-10-25',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE,
    ]);

    expect($member->birth_date)->toBe('25/10/2000');
});

it('formata wedding_date corretamente quando presente', function () {
    $member = Member::create([
        'name' => 'Casado',
        'birth_date' => '1990-01-01',
        'wedding_date' => '2015-09-10',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE,
    ]);

    expect($member->wedding_date)->toBe('10/09/2015');
});

it('retorna null para datas não preenchidas', function () {
    $member = Member::create([
        'name' => 'Sem datas',
        'birth_date' => '1990-01-01',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE,
    ]);

    expect($member->wedding_date)->toBeNull()
        ->and($member->baptism_date)->toBeNull()
        ->and($member->dismissed_date)->toBeNull();
});

it('cast de gender retorna enum', function () {
    $member = Member::create([
        'name' => 'Enum Teste',
        'birth_date' => '2000-01-01',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::FEMALE,
    ]);

    expect($member->gender)->toBeInstanceOf(MemberGenderEnum::class)
        ->and($member->gender)->toBe(MemberGenderEnum::FEMALE);
});

it('pode ser soft deleted', function () {
    $auth = User::factory()->create();
    $this->actingAs($auth);

    $member = Member::factory()->create();

    $member->delete();

    expect(Member::count())->toBe(0)
        ->and(Member::withTrashed()->count())->toBe(1);
});

it('pode ser restaurado após soft delete', function () {
    $auth = User::factory()->create();
    $this->actingAs($auth);

    $member = Member::factory()->create();
    $member->delete();

    $restored = Member::withTrashed()->find($member->id);
    $restored->restore();

    expect(Member::count())->toBe(1)
        ->and(Member::withTrashed()->count())->toBe(1)
        ->and(Member::onlyTrashed()->count())->toBe(0);
});

it('relacionamento address ainda está acessível após soft delete', function () {
    $auth = User::factory()->create();
    $this->actingAs($auth);

    $member = Member::factory()->create();
    $member->address()->create([
        'street' => 'Rua 123',
        'number' => '45',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'UF',
        'zipcode' => '00000-000',
    ]);

    $member->delete();

    $deleted = Member::withTrashed()->find($member->id);

    expect($deleted->address)->not->toBeNull()
        ->and($deleted->address->street)->toBe('Rua 123');
});

it('fillable bloqueia campos não permitidos', function () {
    $member = Member::create([
        'name' => 'José',
        'birth_date' => '1990-01-01',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE,
        'unexpected_field' => 'hack', // não está em fillable
    ]);

    expect(isset($member->unexpected_field))->toBeFalse();
});

it('cast de enum funciona a partir de string', function () {
    $member = Member::create([
        'name' => 'Ana',
        'birth_date' => '1990-01-01',
        'cellphone' => '27999999999',
        'gender' => 'female', // string no banco
    ]);

    expect($member->gender)->toBe(MemberGenderEnum::FEMALE)
        ->and($member->gender)->toBeInstanceOf(MemberGenderEnum::class);
});
