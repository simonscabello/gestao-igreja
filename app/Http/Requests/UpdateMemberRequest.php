<?php

namespace App\Http\Requests;

use App\Rules\ValidPhone;
use App\Enum\MemberGenderEnum;
use Illuminate\Validation\Rule;
use App\Enum\MemberMaritalStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\SanitizesMemberData;

class UpdateMemberRequest extends FormRequest
{
    use SanitizesMemberData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'phone_number' => ['nullable', new ValidPhone()],
            'cellphone' => ['required', new ValidPhone()],
            'email' => ['nullable', 'email', 'max:255', 'min:3'],
            'baptism_date' => ['nullable', 'date_format:d/m/Y'],
            'marital_status' => ['nullable', Rule::enum(MemberMaritalStatusEnum::class)],
            'gender' => ['required', Rule::enum(MemberGenderEnum::class)],
            'admission_date' => ['nullable', 'date_format:d/m/Y'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'complement' => ['nullable', 'string'],
            'neighborhood' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'wedding_date' => ['nullable', 'date_format:d/m/Y'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',

            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date_format' => 'A data de nascimento deve estar no formato dd/mm/yyyy.',

            'phone_number.string' => 'O telefone deve ser um texto.',
            'phone_number.max' => 'O telefone não pode ter mais que 14 caracteres.',
            'phone_number.min' => 'O telefone deve ter no mínimo 8 caracteres.',

            'cellphone.required' => 'O celular é obrigatório.',
            'cellphone.string' => 'O celular deve ser um texto.',
            'cellphone.max' => 'O celular não pode ter mais que 14 caracteres.',
            'cellphone.min' => 'O celular deve ter no mínimo 8 caracteres.',

            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.string' => 'O e-mail deve ser um texto.',
            'email.max' => 'O e-mail não pode ter mais que 255 caracteres.',
            'email.min' => 'O e-mail deve ter no mínimo 3 caracteres.',

            'baptism_date.date_format' => 'A data de batismo deve estar no formato dd/mm/yyyy.',
            'admission_date.date_format' => 'A data de admissão deve estar no formato dd/mm/yyyy.',
            'wedding_date.date_format' => 'A data de casamento deve estar no formato dd/mm/yyyy.',

            'marital_status.enum' => 'O estado civil selecionado é inválido.',
            'gender.required' => 'O campo gênero é obrigatório.',
            'gender.enum' => 'O gênero selecionado é inválido.',

            'street.required' => 'O campo rua é obrigatório.',
            'street.string' => 'A rua deve ser um texto.',

            'number.required' => 'O campo número é obrigatório.',
            'number.string' => 'O número deve ser um texto.',

            'complement.string' => 'O complemento deve ser um texto.',

            'neighborhood.required' => 'O campo bairro é obrigatório.',
            'neighborhood.string' => 'O bairro deve ser um texto.',

            'city.required' => 'O campo cidade é obrigatório.',
            'city.string' => 'A cidade deve ser um texto.',

            'state.required' => 'O campo estado é obrigatório.',
            'state.string' => 'O estado deve ser um texto.',

            'zipcode.required' => 'O campo CEP é obrigatório.',
            'zipcode.string' => 'O CEP deve ser um texto.',
        ];
    }
}
