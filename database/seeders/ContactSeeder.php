<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'province_id' => 16,
            'regency_id' => 1671,
            'district_id' => 1671040,
            'village_id' => 1671040001,
            'zip_code' => 30128,
            'phone' => '081271525366',
            'email' => 'labmultimedia@gmail.com',
            'address' => 'Fakultas Ilmu Komputer Universitas Sriwijaya'
        ]);
    }
}
