<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Monolog\Handler\NullHandler;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                "name" => "Dashboard",
                "desc" => "Asosiy panelni ko'rish"
            ],
            [
                "name" => "Employees",
                "desc" => "Xodimlarni ko'rish"
            ],
            [
                "name" => "Role&Permissions",
                "desc" => "Rol va ruxsatlar"
            ],
            [
                "name" => "Settings",
                "desc" => "Sozlamalar"
            ],
           
        ];

        $newMenus = [];
        foreach ($menus as $menu){
            $isMenu = Menu::where('name', $menu['name'])->first();
            if (!$isMenu){
                $new = new Menu();
                $new->name = $menu['name'];
                $new->save();
                $newMenus[] = ['name' => $menu['name'], 'id' => $new->id];
            }
        }

        foreach ($newMenus as $menu){

            // Main permission
            Permission::create([
                'name' => 'index',
                'menu_id' => $menu['id'],
                'desc' => "Asosiy menuni korish",
            ]);

            $arr1 = ['Dashboard', 'Payments', 'Reports', 'ExpiredMedicines'];
            $arr2 = ['ExpiredMedicines'];
            if (!in_array($menu['name'], $arr1)){
                // Create
                Permission::create([
                    'name' => 'create',
                    'menu_id' => $menu['id'],
                    'desc' => "Malumotlarni qo'shish",
                ]);
                // Update
                Permission::create([
                    'name' => 'update',
                    'menu_id' => $menu['id'],
                    'desc' => "Malumotlarni tahrirlash",
                ]);
                // Delete
                Permission::create([
                    'name' => 'delete',
                    'menu_id' => $menu['id'],
                    'desc' => "Malumotlarni o'chirish",
                ]);
            }

            if (in_array($menu['name'], $arr2)){
                // Delete
                Permission::create([
                    'name' => 'delete',
                    'menu_id' => $menu['id'],
                    'desc' => "Malumotlarni o'chirish",
                ]);
            }

        }

    }
}
