<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory(1)->create();
        // \App\Models\Dosen::factory(5)->create();
        // \App\Models\User::factory(5)->create();
        // \App\Models\Lead::factory(1)->create();
        // \App\Models\Asistant::factory(1)->create();
        // $this->call(NewscategorySeeder::class);
        // \App\Models\News::factory(3)->create();
        // $this->call(TrainingCategorySeeder::class);
        // \App\Models\Training::factory(5)->create();
        // \App\Models\Trainer::factory(5)->create();
        // \App\Models\Participant::factory(5)->create();
        // \App\Models\Comment::factory(5)->create();
        // $this->call(ReleaseCategorySeeder::class);
        // \App\Models\Release::factory(5)->create();
        // \App\Models\ReleaseComment::factory(5)->create();
        // $this->call(IndoRegionSeeder::class);
        // $this->call(ContactSeeder::class);
        // \App\Models\Profile::factory(1)->create();
        // \App\Models\CommunityDedication::factory(5)->create();
        // \App\Models\ParticipantCommunityDedication::factory(5)->create();
        // \App\Models\Customers::factory(5)->create();
        // \App\Models\Message::factory(5)->create();
        // \App\Models\Reply::factory(5)->create();
        \App\Models\Tool::factory(5)->create();
    }
}
