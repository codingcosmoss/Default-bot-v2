<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Role;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddPrivateRoleAllUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
            $admin = User::where('private', Status::$status_active)
                ->where('clinic_id', $clinic->id)
                ->first();
            if ($admin){
                $role = Role::where('private', Status::$status_active)
                    ->where('clinic_id', $clinic->id)
                    ->first();
                if ($role){
                    $admin->role_id = $role->id;
                    $admin->save();
                }
            }
        }
    }
}
