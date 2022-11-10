<?php

namespace Database\Seeders;

use App\Models\Training;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    public function run()
    {
        Training::factory(5)->create();
    }
}
