<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Question;

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
        return [
            //
            'question' => $this->faker->text(255),
            'created_by' => User::all()->random()->id
        ];
    }
}
