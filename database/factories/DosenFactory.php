<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nip' => $this->faker->randomDigit,
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
