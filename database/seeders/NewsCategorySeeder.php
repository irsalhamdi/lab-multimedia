<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsCategory::create([
            'name' => 'Digital Marketing'
        ]);
        NewsCategory::create([
            'name' => 'Virtual Reality'
        ]);
        NewsCategory::create([
            'name' => 'Editing'
        ]);
    }
}
