<?php

use App\Enum\MemberGenderEnum;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreMemberRequest;

function validateStoreMember(array $data): \Illuminate\Validation\Validator
{
    $request = new StoreMemberRequest();
    return Validator::make($data, $request->rules());
}

it('valida um membro com dados mínimos obrigatórios', function () {
    $data = [
        'name' => 'João da Silva',
        'birth_date' => '01/01/1990',
        'cellphone' => '27999999999',
        'gender' => MemberGenderEnum::MALE->value,
        'street' => 'Rua A',
        'number' => '100',
        'neighborhood' => 'Centro',
        'city' => 'Vitória',
        'state' => 'ES',
        'zipcode' => '29000-000',
    ];

    $validator = validateStoreMember($data);

    expect($validator->fails())->toBeFalse();
});

it('falha se campos obrigatórios estiverem ausentes', function () {
    $validator = validateStoreMember([]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->keys())->toContain(
            'name', 'birth_date', 'cellphone', 'gender', 'street', 'number', 'neighborhood', 'city', 'state', 'zipcode'
        );
});

it('falha com valores inválidos em enums', function () {
    $data = [
        'name' => 'Ana',
        'birth_date' => '01/01/1990',
        'cellphone' => '27999999999',
        'gender' => 'inválido',
        'marital_status' => 'estranho',
        'street' => 'Rua B',
        'number' => '200',
        'neighborhood' => 'Bairro',
        'city' => 'Serra',
        'state' => 'ES',
        'zipcode' => '00000-000',
    ];

    $validator = validateStoreMember($data);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('gender'))->toBeTrue()
        ->and($validator->errors()->has('marital_status'))->toBeTrue();
});
