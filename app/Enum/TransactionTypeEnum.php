<?php

namespace App\Enum;

enum TransactionTypeEnum: string
{
    use ValuesToArray;

    case INCOME = 'income';
    case EXPENSE = 'expense';

    public function label(): string
    {
        return match ($this->value) {
            self::INCOME->value => 'Entrada',
            self::EXPENSE->value => 'Saída',
            default => 'Unknown',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::INCOME->value => 'success',
            self::EXPENSE->value => 'danger',
            default => 'secondary',
        };
    }
}
