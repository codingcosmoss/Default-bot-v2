<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ExpenseCategory;
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
        $user = User::find(1);
        $user->password = Hash::make('121212');
        $user->save();

        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
            $isCategory = User::where('clinic_id', $clinic->id)->first();
            if (!$isCategory){
                // Admin
                User::create([
                    'name' => 'Admin',
                    'login' => 'admin',
                    'phone' => '0000',
                    'password' =>  Hash::make('12345678adc') , // avvalgisi 121212
                    'clinic_id' => $clinic->id,
                    'role_id' => 1
                ]);
            }
        }



    }
}
