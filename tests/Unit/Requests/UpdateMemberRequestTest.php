<?php

use App\Enum\MemberGenderEnum;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateMemberRequest;

function validateUpdateMember(array $data): \Illuminate\Validation\Validator
{
    $request = new UpdateMemberRequest();
    return Validator::make($data, $request->rules());
}

it('valida uma atualização de membro com dados válidos', function () {
    $data = [
        'name' => 'Carlos Atualizado',
        'birth_date' => '10/10/1980',
        'cellphone' => '27998887777',
        'gender' => MemberGenderEnum::FEMALE->value,
        'street' => 'Rua Nova',
        'number' => '321',
        'neighborhood' => 'Alto',
        'city' => 'Vila Velha',
        'state' => 'ES',
        'zipcode' => '29100-000',
    ];

    $validator = validateUpdateMember($data);

    expect($validator->fails())->toBeFalse();
});
