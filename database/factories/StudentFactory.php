<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_name' => $this->faker->name(),
            'student_email' => $this->faker->unique()->safeEmail(),
            'student_phone' => $this->faker->numerify('01########'),
        ];
    }

    public function adult()
    {
        return $this->state(function (array $attributes) {
            return [
                'age' => $this->faker->numberBetween(18, 30),
            ];
        });
    }

    public function minor()
    {
        return $this->state(function (array $attributes) {
            return [
                'age' => $this->faker->numberBetween(10, 17),
            ];
        });
    }
}
