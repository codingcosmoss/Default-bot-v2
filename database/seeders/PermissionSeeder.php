<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        foreach ($roles as $role){

           if ($role->name != 'PayingEmployees' &&  $role->name !='GivenMoney' && $role->name != 'Reports'){
               if ($role->name != 'Payments'){
                   Permission::create([
                       'name' => $role->name.'-create',
                       'lang_name' => 'add',
                       'role_id' => $role->id,
                       'description' => "Qo'shish",
                   ]);
               }

               Permission::create([
                   'name' => $role->name.'-update',
                   'lang_name' => 'edit',
                   'role_id' => $role->id,
                   'description' => "Tahrirlash",
               ]);


               // O'shirish
               if ($role->name != 'Patients' && $role->name != 'Treatmetns'){
                   Permission::create([
                       'name' => $role->name.'-delete',
                       'lang_name' => 'delete',
                       'role_id' => $role->id,
                       'description' => "O'shirish",
                   ]);
               }
           }
            //_____________________________________________________________________

            if ($role->name == 'Employees'){
                Permission::create([
                    'name' => $role->name.'-editPassword',
                    'lang_name' => 'editPassword',
                    'role_id' => $role->id,
                    'description' => "Parolni yangilash",
                ]);
            }
            if ($role->name == 'Patients'){
                Permission::create([
                    'name' => $role->name.'-attachEmployee',
                    'lang_name' => 'addDoctor',
                    'role_id' => $role->id,
                    'description' => "Bemorni doctorga biriktrish",
                ]);
            }

            if ($role->name == 'Warehouse'){
                Permission::create([
                    'name' => $role->name.'-groups',
                    'lang_name' => 'Groups',
                    'role_id' => $role->id,
                    'description' => "Ombordagi mahsulot guruxlar bolimiga kirish",
                ]);
                Permission::create([
                    'name' => $role->name.'-products',
                    'lang_name' => 'Products',
                    'role_id' => $role->id,
                    'description' => "Ombordagi mahsulot bo'limiga kirish",
                ]);
                Permission::create([
                    'name' => $role->name.'-collections',
                    'lang_name' => 'Collection',
                    'role_id' => $role->id,
                    'description' => "Ombordagi to'plamlar bo'limiga kirish",
                ]);
                Permission::create([
                    'name' => $role->name.'-documents',
                    'lang_name' => 'Documents',
                    'role_id' => $role->id,
                    'description' => "Ombordagi hujjatlar bo'limiga kirish",
                ]);
                Permission::create([
                    'name' => $role->name.'-suppliers',
                    'lang_name' => 'Suppliers',
                    'role_id' => $role->id,
                    'description' => "Ombordagi yetkazib beruvchilar bo'limiga kirish",
                ]);
                Permission::create([
                    'name' => $role->name.'-categories',
                    'lang_name' => 'category',
                    'role_id' => $role->id,
                    'description' => "Ombordagi kategoriyalari bo'limiga kirish",
                ]);
            }


            if ($role->name == 'Treatments' || $role->name == 'DebtorTreatments'){

                Permission::create([
                    'name' => $role->name.'-treatment',
                    'lang_name' => 'treatment',
                    'role_id' => $role->id,
                    'description' => "Davolash yoki bekor qilish",
                ]);

                Permission::create([
                    'name' => $role->name.'-payOff',
                    'lang_name' => 'payOff',
                    'role_id' => $role->id,
                    'description' => "To'lov qabul qilish",
                ]);
                Permission::create([
                    'name' => $role->name.'-giveDiscount',
                    'lang_name' => 'giveDiscount',
                    'role_id' => $role->id,
                    'description' => "Chegirma beish",
                ]);
                Permission::create([
                    'name' => $role->name.'-debtEnforcement',
                    'lang_name' => 'debtEnforcement',
                    'role_id' => $role->id,
                    'description' => "Qarzga bajarish",
                ]);

                Permission::create([
                    'name' => $role->name.'-finished',
                    'lang_name' => 'finished',
                    'role_id' => $role->id,
                    'description' => "Davolanishni tugatish",
                ]);
            }

        }

    }
}
