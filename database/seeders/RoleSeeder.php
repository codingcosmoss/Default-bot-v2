<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Traits\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
            $isRole = Role::where('clinic_id', $clinic->id)->where('private', Status::$status_active)->first();
            $allPermissions = Permission::all()->pluck('id')->toArray();
            if (!$isRole){
                // new Super admin role
                $role = new Role();
                $role->name = 'Super private admin';
                $role->clinic_id = $clinic->id;
                $role->private = Status::$status_active;
                $role->save();

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
            $defaultRole = new Role();
            $defaultRole->name = 'Admin';
            $defaultRole->clinic_id = $clinic->id;
            $defaultRole->save();

            foreach ($allPermissions as $permission){
                $modelPermission = Permission::find($permission);
                $menu = Menu::find($modelPermission->menu_id);
                if ($menu){
                    $model = new RolePermission();
                    $model->role_id = $defaultRole->id;
                    $model->permission_id = $permission;
                    $model->permission_name = $menu->name.'-'.$modelPermission->name;
                    $model->save();
                }
            }
        }

    }
}
