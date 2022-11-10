<?php

namespace Database\Seeders;

use App\Models\ReleaseCategory;
use Illuminate\Database\Seeder;

class ReleaseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReleaseCategory::create([
            'name' => 'Digital Marketing'
        ]);
        ReleaseCategory::create([
            'name' => 'Virtual Reality'
        ]);
        ReleaseCategory::create([
            'name' => 'Editing'
        ]);
    }
}
