<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminAddPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesIds = Role::pluck('id')->toArray();
        $roles = Role::all();
        $permissions = Permission::all();
        $user = User::where( 'login', 'admin')->first();
        $user->permissions()->attach($rolesIds);
        foreach ($roles as $role){
            foreach ($role->permissions as $permission){
                $model = new UserPermission();
                $model->user_id = $user->id;
                $model->permission_id = $permission->id;
                $model->role_id = $role->id;
                $model->save();
            }
        }
    }
}
