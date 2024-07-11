<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Admin
        User::create([
            'name' => 'Admin',
            'login' => 'admin',
            'phone' => '0000',
            'password' =>  Hash::make('12345678adc') , // avvalgisi 121212
            'clinic_id' => 1,
            'role_id' => 1
        ]);

    }
}
