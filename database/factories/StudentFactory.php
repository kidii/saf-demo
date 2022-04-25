<?php

namespace Database\Factories;

use App\Enums\StudentSex;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'sex' => collect(StudentSex::cases())->random()->value,
            'email' => $this->faker->unique()->safeEmail(),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->dateTimeBetween('-18 years', '-14 years')
        ];
    }
}
