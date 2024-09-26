<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Enum\MemberGenderEnum;
use Illuminate\Validation\Rule;
use App\Enum\MemberMaritalStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $birthDate = $this->get('birth_date');
        $baptismDate = $this->get('baptism_date');
        $admissionDate = $this->get('admission_date');
        $weddingDate = $this->get('wedding_date');

        if ($birthDate) {
            $birthDate = Carbon::createFromFormat('d/m/Y', $birthDate);
        }
        if ($baptismDate) {
            $baptismDate = Carbon::createFromFormat('d/m/Y', $baptismDate);
        }
        if ($admissionDate) {
            $admissionDate = Carbon::createFromFormat('d/m/Y', $admissionDate);
        }
        if ($weddingDate) {
            $weddingDate = Carbon::createFromFormat('d/m/Y', $weddingDate);
        }

        $this->merge([
            'birth_date' => $birthDate,
            'baptism_date' => $baptismDate,
            'admission_date' => $admissionDate,
            'wedding_date' => $weddingDate,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'birth_date' => ['required', 'date:d/m/Y'],
            'phone_number' => ['nullable', 'string', 'max:14', 'min:8'],
            'cellphone' => ['required', 'string', 'max:14', 'min:8'],
            'email' => ['nullable', 'email', 'max:255', 'min:3'],
            'baptism_date' => ['nullable', 'date:d/m/Y'],
            'marital_status' => ['nullable', Rule::enum(MemberMaritalStatusEnum::class)],
            'gender' => ['required', Rule::enum(MemberGenderEnum::class)],
            'admission_date' => ['nullable', 'date:d/m/Y'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'complement' => ['nullable', 'string'],
            'neighborhood' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'wedding_date' => ['nullable', 'date:d/m/Y'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'birth_date.required' => 'O campo data de nascimento é obrigatório',
            'birth_date.date' => 'O campo data de nascimento deve ser uma data',
            'phone_number.string' => 'O campo telefone deve ser uma string',
            'phone_number.max' => 'O campo telefone deve ter no máximo 14 caracteres',
            'phone_number.min' => 'O campo telefone deve ter no mínimo 8 caracteres',
            'cellphone.string' => 'O campo celular deve ser uma string',
            'cellphone.max' => 'O campo celular deve ter no máximo 14 caracteres',
            'cellphone.min' => 'O campo celular deve ter no mínimo 8 caracteres',
            'cellphone.required' => 'O campo celular é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres',
            'email.min' => 'O campo email deve ter no mínimo 3 caracteres',
            'baptism_date.date' => 'O campo data de batismo deve ser uma data',
            'marital_status.enum' => 'O campo estado civil deve ser um dos valores: ' . implode(', ', MemberMaritalStatusEnum::valuesToArray()),
            'gender.enum' => 'O campo gênero deve ser um dos valores: ' . implode(', ', MemberGenderEnum::valuesToArray()),
            'gender.required' => 'O campo gênero é obrigatório',
            'admission_date.date' => 'O campo data de admissão deve ser uma data',
            'street.required' => 'O campo rua é obrigatório',
            'street.string' => 'O campo rua deve ser uma string',
            'number.required' => 'O campo número é obrigatório',
            'number.string' => 'O campo número deve ser uma string',
            'complement.string' => 'O campo complemento deve ser uma string',
            'neighborhood.required' => 'O campo bairro é obrigatório',
            'neighborhood.string' => 'O campo bairro deve ser uma string',
            'city.required' => 'O campo cidade é obrigatório',
            'city.string' => 'O campo cidade deve ser uma string',
            'state.required' => 'O campo estado é obrigatório',
            'state.string' => 'O campo estado deve ser uma string',
            'zip_code.required' => 'O campo CEP é obrigatório',
            'zip_code.string' => 'O campo CEP deve ser uma string',
            'wedding_date.date' => 'O campo data de casamento deve ser uma data',
        ];
    }
}
