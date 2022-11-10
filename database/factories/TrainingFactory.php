<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'training_categories_id' => mt_rand(1,3),
            'name' => $this->faker->sentence(mt_rand(2,8)),
            'description' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                                ->map(fn($p) => "<p>$p</p>")
                                ->implode(''),
            'participants' => mt_rand(1,50),
            'place' => 'Lab Multimedia',
            'date' => $this->faker->dateTime(),
            'zoom' => $this->faker->url(),
            'whatsapp' => $this->faker->url(),
            'status' => '1',
        ];
    }
}
