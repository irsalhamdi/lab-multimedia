<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{

    public function run()
    {
        Dosen::factory(5)->create();
    }
}
