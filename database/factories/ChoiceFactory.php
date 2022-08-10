<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'option' => $this->faker->paragraph(1),
            'right_answer' => $this->faker->numberBetween(0,1)
        ];
    }
}
