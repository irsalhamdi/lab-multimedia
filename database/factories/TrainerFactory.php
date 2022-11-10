<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'training_id' => mt_rand(1,5),
            'name' => $this->faker->name,
            'profile' => $this->faker->sentence(mt_rand(2,8)),
            'job' => $this->faker->title,
        ];
    }
}
