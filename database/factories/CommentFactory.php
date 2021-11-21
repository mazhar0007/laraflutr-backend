<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Question;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
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
            'comment' => $this->faker->text(255),
            'question_id' => Question::all()->random()->id,
            'created_by' => User::all()->random()->id

        ];
    }
}
