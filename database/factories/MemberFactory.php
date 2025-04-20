<?php

namespace Database\Factories;

use App\Models\Member;
use App\Enum\MemberGenderEnum;
use App\Enum\MemberMaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date(),
            'phone_number' => $this->faker->numerify('(27)####-####'),
            'cellphone' => $this->faker->numerify('(27)9####-####'),
            'email' => $this->faker->unique()->safeEmail,
            'baptism_date' => $this->faker->optional()->date(),
            'marital_status' => $this->faker->randomElement(MemberMaritalStatusEnum::valuesToArray()),
            'gender' => $this->faker->randomElement(MemberGenderEnum::valuesToArray()),
            'admission_date' => $this->faker->date(),
            'dismissed_date' => null,
            'deleted_by' => null,
            'wedding_date' => $this->faker->optional()->date(),
        ];
    }
}
