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
            'password' =>  Hash::make('560605860608') , // avvalgisi 121212
            'position' => 'Admin',
            'role' => 'admin'
        ]);

    }
}
