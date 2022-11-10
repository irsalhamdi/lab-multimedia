<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantCommunityDedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dosen_id' => mt_rand(1,5),
            'user_id' => mt_rand(1,5),
            'dedication_id' => mt_rand(1,5),
        ];
    }
}
