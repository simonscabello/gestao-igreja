<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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

        if ($birthDate) {
            $birthDate = Carbon::createFromFormat('d/m/Y', $birthDate);
        }
        if ($baptismDate) {
            $baptismDate = Carbon::createFromFormat('d/m/Y', $baptismDate);
        }
        if ($admissionDate) {
            $admissionDate = Carbon::createFromFormat('d/m/Y', $admissionDate);
        }

        $this->merge([
            'birth_date' => $birthDate,
            'baptism_date' => $baptismDate,
            'admission_date' => $admissionDate,
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
            'marital_status' => ['nullable', 'string'],
            'gender' => ['required', 'string'],
            'admission_date' => ['nullable', 'date:d/m/Y'],
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
            'marital_status.string' => 'O campo estado civil deve ser uma string',
            'gender.string' => 'O campo gênero deve ser uma string',
            'gender.required' => 'O campo gênero é obrigatório',
        ];
    }
}
