<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasswordResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinic = Clinic::first();
        $user =  User::where('clinic_id', $clinic->id)
                ->first();
        $user->login = 'admin';
        $user->password = Hash::make('12345678adc');
        $user->save();
    }
}
