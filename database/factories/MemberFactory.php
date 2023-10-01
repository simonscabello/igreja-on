<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Address;
use App\Enum\GenderEnum;
use App\Enum\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'birth_date' => Carbon::make(fake()->date()),
            'gender' => GenderEnum::MALE,
            'marital_status' => MaritalStatusEnum::SINGLE,
            'identification_number' => fake()->cpf(false),
        ];
    }
}
