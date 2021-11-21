<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Opportunity;
use App\Models\Lookups\Category;
use App\Models\Lookups\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OpportunityFactory extends Factory
{
    protected $model = \App\Models\Opportunity::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->sentence(15, true),
            'description' => $this->faker->text(500),
            'category_id' => Category::all()->random()->id,
            'country_id' =>  Country::all()->random()->id,
            'deadline' => $this->faker->dateTime(),
            'organizer' => $this->faker->company,
            'created_by' => User::all()->random()->id
        ];
    }
}
