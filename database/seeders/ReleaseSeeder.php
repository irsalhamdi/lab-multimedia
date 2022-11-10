<?php

namespace Database\Seeders;

use App\Models\Release;
use Illuminate\Database\Seeder;

class ReleaseSeeder extends Seeder
{
    public function run()
    {   
        Release::factory(5)->create();
    }
}
