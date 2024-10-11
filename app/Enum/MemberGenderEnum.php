<?php

namespace App\Enum;

enum MemberGenderEnum: string
{
    use ValuesToArray;

    case FEMALE = 'female';
    case MALE = 'male';

    public function label(): string
    {
        return match ($this->value) {
            self::FEMALE->value => 'Feminino',
            self::MALE->value => 'Masculino',
            default => 'Não informado',
        };
    }
}
