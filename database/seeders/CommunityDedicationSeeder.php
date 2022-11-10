<?php

namespace Database\Seeders;

use App\Models\CommunityDedication;
use Illuminate\Database\Seeder;

class CommunityDedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommunityDedication::factory(5)->create();
    }
}
