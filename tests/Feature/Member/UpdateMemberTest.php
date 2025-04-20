<?php

use App\Models\User;
use App\Models\Member;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enum\MemberGenderEnum;
use App\Enum\MemberMaritalStatusEnum;

uses(RefreshDatabase::class);

function createMemberWithAddress(): Member {
    $member = Member::create([
        'name' => 'Antigo Nome',
        'birth_date' => '1990-01-01',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
    ]);

    $member->address()->create([
        'street' => 'Rua Antiga',
        'number' => '1',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'ES',
        'zipcode' => '29000-000',
    ]);

    return $member;
}

it('atualiza um membro com endereço', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = createMemberWithAddress();

    $data = [
        'name' => 'Novo Nome',
        'birth_date' => '10/10/1990',
        'phone_number' => '(27) 3333-1234',
        'cellphone' => '(27) 99999-1234',
        'email' => 'novo@email.com',
        'baptism_date' => '01/01/2010',
        'marital_status' => MemberMaritalStatusEnum::MARRIED->value,
        'gender' => MemberGenderEnum::MALE->value,
        'admission_date' => '01/01/2020',
        'wedding_date' => '01/01/2015',
        'street' => 'Rua Nova',
        'number' => '123',
        'complement' => 'Casa B',
        'neighborhood' => 'Novo Bairro',
        'city' => 'Nova Cidade',
        'state' => 'ES',
        'zipcode' => '29100-000',
    ];

    $response = $this->put("/member/{$member->id}", $data);

    $response->assertRedirectToRoute('member.show', $member);
    expect($member->refresh()->name)->toBe('Novo Nome');
});

it('retorna erro de validação se campos obrigatórios estiverem ausentes', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = createMemberWithAddress();

    $response = $this->put("/member/{$member->id}", []);

    $response->assertSessionHasErrors([
        'name',
        'birth_date',
        'cellphone',
        'gender',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'zipcode',
    ]);
});

it('aceita atualização com campos opcionais vazios', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = createMemberWithAddress();

    $data = [
        'name' => 'Nome Opcional',
        'birth_date' => '01/01/1991',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::FEMALE->value,
        'street' => 'Rua Central',
        'number' => '999',
        'neighborhood' => 'Bairro Legal',
        'city' => 'Cidade Legal',
        'state' => 'ES',
        'zipcode' => '29000-000',

        // opcionais como null
        'phone_number' => null,
        'email' => null,
        'baptism_date' => null,
        'marital_status' => null,
        'admission_date' => null,
        'wedding_date' => null,
        'complement' => null,
    ];

    $response = $this->put("/member/{$member->id}", $data);

    $response->assertRedirectToRoute('member.show', $member);
    expect($member->refresh()->email)->toBeNull();
});

it('retorna erro se email for inválido', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = createMemberWithAddress();

    $data = [
        'name' => 'Com Email Ruim',
        'birth_date' => '01/01/1992',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
        'email' => 'email-errado',
        'street' => 'Rua',
        'number' => '1',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'ES',
        'zipcode' => '29000-000',
    ];

    $response = $this->put("/member/{$member->id}", $data);

    $response->assertSessionHasErrors(['email']);
});

it('retorna erro se gênero ou estado civil forem inválidos', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = createMemberWithAddress();

    $data = [
        'name' => 'Errado',
        'birth_date' => '01/01/1990',
        'cellphone' => '27999999999',
        'gender' => 'banana', // inválido
        'marital_status' => 'abacaxi', // inválido
        'street' => 'Rua',
        'number' => '1',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'ES',
        'zipcode' => '29000-000',
    ];

    $response = $this->put("/member/{$member->id}", $data);

    $response->assertSessionHasErrors(['gender', 'marital_status']);
});
