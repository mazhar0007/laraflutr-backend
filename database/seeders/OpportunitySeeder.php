<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use App\Models\OpportunityDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // \App\Models\Opportunity::factory()->count(300)->create()->each(function($opportunity) {
        //     $opportunity->detail()->save(factory(\App\Models\OpportunityDetail::class)->make());
        // });

        \App\Models\Opportunity::factory()->times(300)->create()->each(function($opportunity) {
            $opportunity->detail()->save(\App\Models\OpportunityDetail::factory()->make());
        });
    }
}
