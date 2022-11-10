<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReleaseCommentFactory extends Factory
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
            'release_id' => mt_rand(1,3),
            'comment' => $this->faker->sentence(mt_rand(2,8)),
        ];
    }
}
