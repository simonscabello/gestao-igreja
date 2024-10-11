<?php

namespace App\Enum;

trait ValuesToArray
{
    public static function valuesToArray(): array
    {
        $output = [];

        foreach (self::cases() as $case) {
            $output[] = $case->value;
        }

        return $output;
    }
}
