<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vission' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                            ->map(fn($p) => "<p>$p</p>")
                            ->implode(''),
            'mission' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                            ->map(fn($p) => "<p>$p</p>")
                            ->implode(''),
            'goal' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                            ->map(fn($p) => "<p>$p</p>")
                            ->implode(''),
        ];
    }
}
