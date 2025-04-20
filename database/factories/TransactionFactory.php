<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transaction;
use App\Models\FinancialCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->date(),
            'financial_category_id' => FinancialCategory::factory(),
            'user_id' => User::factory(),
        ];
    }
}
