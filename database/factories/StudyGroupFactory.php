<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudyGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subjects = array(
            'math',
            'physics',
            'chemist',
            'informatics',
            'gymnastic'
        );

        return [
            'leader' => $this->faker->name(),
            'subject' => $subjects[array_rand($subjects)],
            'beginning_at' => now()->addMinutes(rand(0,240))
        ];
    }
}
