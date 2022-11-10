<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,5),
            'training_id' => mt_rand(1,5),
            'absent' => 'tidak hadir',
        ];
    }
}
