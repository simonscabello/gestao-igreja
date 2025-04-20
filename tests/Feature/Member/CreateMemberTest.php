<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enum\MemberGenderEnum;
use App\Enum\MemberMaritalStatusEnum;

uses(RefreshDatabase::class);

it('cria um membro com endereço', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Simon Scabello',
        'birth_date' => '30/06/1994',
        'phone_number' => '(27) 3333-1234',
        'cellphone' => '(27) 99999-1234',
        'email' => 'simon@example.com',
        'baptism_date' => '01/01/2010',
        'marital_status' => MemberMaritalStatusEnum::MARRIED->value,
        'gender' => MemberGenderEnum::MALE->value,
        'admission_date' => '01/01/2020',
        'wedding_date' => '01/01/2015',
        'street' => 'Rua das Laranjeiras',
        'number' => '123',
        'complement' => 'Apto 101',
        'neighborhood' => 'Centro',
        'city' => 'Vitória',
        'state' => 'ES',
        'zipcode' => '29090-090',
    ];

    $response = $this->post('/member', $data);

    $createdMember = Member::latest('id')->first();

    $response->assertRedirectToRoute('member.show', ['member' => $createdMember->id]);
    expect(Member::count())->toBe(1)
        ->and(Member::first()->address)->not->toBeNull();
});

it('bloqueia criação de membro para usuários não autenticados', function () {
    $response = $this->post('/member', []);
    $response->assertRedirect('/login');
});

it('retorna erro de validação se campos obrigatórios estiverem ausentes', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/member', []);

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

it('retorna erro se data estiver em formato inválido', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Fulano de Tal',
        'birth_date' => '39/18/2023', // inválido
        'cellphone' => '(27) 99999-1234',
        'gender' => MemberGenderEnum::MALE->value,
        'street' => 'Rua A',
        'number' => '1',
        'neighborhood' => 'Centro',
        'city' => 'Cidade',
        'state' => 'UF',
        'zipcode' => '12345-678',
    ];

    $response = $this->post('/member', $data);

    $response->assertSessionHasErrors(['birth_date']);
});

it('retorna erro se gênero ou estado civil forem inválidos', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Fulano de Tal',
        'birth_date' => '01/01/2000',
        'cellphone' => '(27) 99999-1234',
        'gender' => 'outro', // inválido
        'marital_status' => 'complicado', // inválido
        'street' => 'Rua B',
        'number' => '12',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'UF',
        'zipcode' => '98765-432',
    ];

    $response = $this->post('/member', $data);

    $response->assertSessionHasErrors(['gender', 'marital_status']);
});

it('aceita criação com campos opcionais vazios', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Maria Vaz',
        'birth_date' => '15/07/1990',
        'cellphone' => '(27) 99999-1234',
        'gender' => MemberGenderEnum::FEMALE->value,
        'street' => 'Rua das Flores',
        'number' => '55',
        'neighborhood' => 'Alecrim',
        'city' => 'Cachoeiro',
        'state' => 'ES',
        'zipcode' => '29000-000',

        // campos opcionais:
        'phone_number' => null,
        'email' => null,
        'baptism_date' => null,
        'marital_status' => null,
        'admission_date' => null,
        'wedding_date' => null,
        'complement' => null,
    ];

    $response = $this->post('/member', $data);

    $createdMember = Member::latest('id')->first();

    $response->assertRedirectToRoute('member.show', ['member' => $createdMember->id]);
    expect(Member::count())->toBe(1)
        ->and(Member::first()->email)->toBeNull();
});

it('retorna erro se email for inválido', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'João da Silva',
        'birth_date' => '10/10/1980',
        'cellphone' => '(27) 99999-0000',
        'gender' => MemberGenderEnum::MALE->value,
        'email' => 'email-invalido', // <- aqui
        'street' => 'Rua Alfa',
        'number' => '42',
        'neighborhood' => 'Beta',
        'city' => 'Gama',
        'state' => 'ES',
        'zipcode' => '29100-000',
    ];

    $response = $this->post('/member', $data);

    $response->assertSessionHasErrors(['email']);
});

it('retorna erro se telefone fixo tiver poucos dígitos', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Carlos Fixo',
        'birth_date' => '05/05/1995',
        'phone_number' => '1234', // inválido
        'cellphone' => '(27) 99999-4321',
        'gender' => MemberGenderEnum::MALE->value,
        'street' => 'Rua Teste',
        'number' => '7',
        'neighborhood' => 'Centro',
        'city' => 'Vila Velha',
        'state' => 'ES',
        'zipcode' => '29100-000',
    ];

    $response = $this->post('/member', $data);

    $response->assertSessionHasErrors(['phone_number']);
});

it('retorna erro se celular tiver menos de 11 dígitos', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Lucas Celular',
        'birth_date' => '01/01/1990',
        'cellphone' => '99999-123', // inválido
        'gender' => MemberGenderEnum::MALE->value,
        'street' => 'Rua Azul',
        'number' => '10',
        'neighborhood' => 'Azulão',
        'city' => 'Linhares',
        'state' => 'ES',
        'zipcode' => '29300-000',
    ];

    $response = $this->post('/member', $data);

    $response->assertSessionHasErrors(['cellphone']);
});
