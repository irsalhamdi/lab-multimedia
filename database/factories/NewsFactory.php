<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'news_categories_id' => mt_rand(1,3),
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'description' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                                ->map(fn($p) => "<p>$p</p>")
                                ->implode(''),
            'excerpt' => Str::limit(strip_tags($this->faker->paragraph()), 200),
        ];
    }
}
