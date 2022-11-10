<?php

namespace Database\Seeders;

use App\Models\ReleaseComment;
use Illuminate\Database\Seeder;

class ReleaseCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReleaseComment::factory(5)->create();
    }
}
