<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom_name' => fake()->name(),
            'classroom_description' => fake()->sentence(),
        ];
    }
    // public function configure()
    // {
    //     return $this->afterCreating(function (\App\Models\Classroom $classroom) {
    //         \App\Models\Student::factory(rand(5, 15))->create([
    //             'classroom_id' => $classroom->id
    //         ]);
    //     });
    // }
}
