<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Traits\Status;
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

        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
            $isCategory = User::where('clinic_id', $clinic->id)->first();
            if (!$isCategory){
                // Admin
                User::create([
                    'name' => 'Admin',
                    'login' => 'superadmin'.$clinic->id,
                    'phone' => '0000',
                    'position' => 'Admin',
                    'password' =>  Hash::make('12345678adc') , // avvalgisi 121212
                    'clinic_id' => $clinic->id,
                    'private' => Status::$status_active
                ]);
            }
        }



    }
}
