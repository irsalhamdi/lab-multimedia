<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
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
            'new_id' => mt_rand(1,3),
            'comment' => $this->faker->sentence(mt_rand(2,8)),
        ];
    }
}
