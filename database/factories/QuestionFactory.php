<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $input = ['easy', 'normal', 'hard'];

        return [
            'header' => $this->faker->paragraph(4),
            'diffculty' => $input[rand(0,2)],
        ];
    }
}
