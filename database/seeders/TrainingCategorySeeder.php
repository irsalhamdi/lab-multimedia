<?php

namespace Database\Seeders;

use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class TrainingCategorySeeder extends Seeder
{
    public function run()
    {
        TrainingCategory::create([
            'name' => 'Digital Marketing'
        ]);
        TrainingCategory::create([
            'name' => 'Virtual Reality'
        ]);
        TrainingCategory::create([
            'name' => 'Editing'
        ]);
    }
}
