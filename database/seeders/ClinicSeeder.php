<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clinic::create([
            'name' => 'Pharma plus',
            'address' => 'Uzbekistan Ferghana',
            'phone' => '+998951112233',
            'email' => 'example@email.com',
        ]);
    }
}
