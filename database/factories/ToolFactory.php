<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2,8)),
            'quantity' => mt_rand(1,50),
            'description' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                                ->map(fn($p) => "<p>$p</p>")
                                ->implode(''),
        ];
    }
}
