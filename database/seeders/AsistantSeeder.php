<?php

namespace Database\Seeders;

use App\Models\Asistant;
use Illuminate\Database\Seeder;

class AsistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asistant::factory(1)->create();
    }
}
