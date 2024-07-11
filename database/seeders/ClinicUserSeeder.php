<?php

namespace Database\Seeders;

use App\Models\ClinicUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClinicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClinicUser::create([
            'name' => 'Super Admin',
            'login' => 'superadmin',
            'password' => Hash::make('12345678abc')
        ]);
    }
}
