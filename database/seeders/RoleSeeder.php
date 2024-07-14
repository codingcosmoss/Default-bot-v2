<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // new Super admin role
        $role = new Role();
        $role->name = 'Super admin';
        $role->clinic_id = 1;
        $role->save();

        $allPermissions = Permission::all()->pluck('id')->toArray();
        foreach ($allPermissions as $permission){
            $modelPermission = Permission::find($permission);
            $menu = Menu::find($modelPermission->menu_id);
            if ($menu){
                $model = new RolePermission();
                $model->role_id = $role->id;
                $model->permission_id = $permission;
                $model->permission_name = $menu->name.'-'.$modelPermission->name;
                $model->save();
            }
        }
    }
}
