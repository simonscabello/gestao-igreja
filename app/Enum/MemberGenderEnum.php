<?php

namespace App\Enum;

enum MemberGenderEnum: string
{
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

    public static function valuesToArray(): array
    {
        $output = [];

        foreach (self::cases() as $case) {
            $output[] = $case->value;
        }

        return $output;
    }
}
