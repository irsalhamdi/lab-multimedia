<?php

namespace Database\Seeders;

use App\Models\ParticipantCommunityDedication;
use Illuminate\Database\Seeder;

class ParticipantsCommunityDedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParticipantCommunityDedication::factory(5)->create();
    }
}
