<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->numerify('code###'),
            'access_code' => $this->faker->numberBetween(100000, 999999),
            'description' => $this->faker->paragraph(4),
            'image' => 'null'
        ];
    }
}
