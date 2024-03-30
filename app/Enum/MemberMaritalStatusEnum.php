<?php

namespace App\Enum;

enum MemberMaritalStatusEnum: string
{
    case SINGLE = 'single';
    case MARRIED = 'married';
    case DIVORCED = 'divorced';
    case WIDOWER = 'widower';

    public function label(): string
    {
        return match ($this->value) {
            self::SINGLE->value => 'Solteiro',
            self::MARRIED->value => 'Casado',
            self::DIVORCED->value => 'Divorciado',
            self::WIDOWER->value => 'Viúvo',
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
