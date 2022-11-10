<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
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
            'admin_id' => 1,
            'message' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                                ->map(fn($p) => "<p>$p</p>")
                                ->implode(''),
            'excerpt' => Str::limit(strip_tags($this->faker->paragraph()), 200),
        ];
    }
}
