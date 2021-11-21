<?php

namespace Database\Factories;

use App\Models\OpportunityDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityDetailFactory extends Factory
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
            'benefites' => $this->faker->text(600),
            'application_process' => $this->faker->text(400),
            'further_queries' => $this->faker->text(400),
            'eligibilities' => $this->faker->text(500),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'official_link' => $this->faker->url
        ];
    }
}
