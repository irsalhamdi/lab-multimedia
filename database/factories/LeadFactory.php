<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Ali ibrahim',
            'email' => 'aliibrahim@gmail.com',
            'nip' => '1671042107840007',
            'jurusan' => 'Sistem Informasi',
            'phone' => '081271525366',
            'address' => 'Palembang',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        ];
    }
}
