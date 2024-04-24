<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //            [
//                'name' => 'deleteContents',
//                'lang_name' => 'deleteContents'
//
//            ],
//            [
//                'name' => 'addContents',
//                'lang_name' => 'addContents'
//            ],
//            [
//                'name' => 'editContents',
//                'lang_name' => 'editContents'
//            ],
        $permissions = [
            [
                'name' => 'Employees',
                'lang_name' => 'employees'
            ],
            [
                'name' => 'Services',
                'lang_name' => 'services'
            ],
            [
                'name' => 'ServiceCategories',
                'lang_name' => 'service_types'
            ],
            [
                'name' => 'Patients',
                'lang_name' => 'Patients'
            ],
            [
                'name' => 'Treatments',
                'lang_name' => 'Treatmetns'
            ],
            [
                'name' => 'Diseases',
                'lang_name' => 'diseases'
            ],
            [
                'name' => 'DebtorTreatments',
                'lang_name' => 'DebtTreatments'
            ],
            [
                'name' => 'Payments',
                'lang_name' => 'Payments'
            ],
            [
                'name' => 'PaymentTypes',
                'lang_name' => 'PaymentTypes'
            ],
            [
                'name' => 'Warehouse',
                'lang_name' => 'Warehouse'
            ],

            [
                'name' => 'Settings',
                'lang_name' => 'Settings'
            ],
            [
                'name' => 'Telegram',
                'lang_name' => 'Telegram'
            ],
            [
                'name' => 'DailyExpenses',
                'lang_name' => 'DailyExpenses'
            ],
            [
                'name' => 'GivenMoney',
                'lang_name' => 'GivenMoney'
            ],
            [
                'name' => 'PayingEmployees',
                'lang_name' => 'PayingEmployees'
            ],
            [
                'name' => 'Reports',
                'lang_name' => 'Reports'
            ],

        ];

        foreach ($permissions as $value){
            $permission = Role::create([
                'name' => $value['name'],
                'lang_name' => $value['lang_name'],
            ]);
        }

    }
}
