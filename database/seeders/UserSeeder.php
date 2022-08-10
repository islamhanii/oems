<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Choice;
use App\Models\Course;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(
            Course::factory()->has(
                Bank::factory()->has(
                    Question::factory()->has(
                        Choice::factory()->count(rand(3, 5))
                    )->count(rand(10,15))
                )->count(rand(2,3))
            )->count(rand(3,5))
        )->count(5)->create();
    }
}
