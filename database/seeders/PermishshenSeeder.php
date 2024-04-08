<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermishshenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            [
                'name' => 'showEmployees',
                'lang_name' => 'employees'
            ],
            [
                'name' => 'showServices',
                'lang_name' => 'services'
            ],
            [
                'name' => 'showServiceCategories',
                'lang_name' => 'service_types'
            ],
            [
                'name' => 'showPatients',
                'lang_name' => 'Patients'
            ],
            [
                'name' => 'showTreatments',
                'lang_name' => 'Treatmetns'
            ],
            [
                'name' => 'showDiseases',
                'lang_name' => 'diseases'
            ],
            [
                'name' => 'showDebtorTreatments',
                'lang_name' => 'DebtTreatments'
            ],
            [
                'name' => 'showPayments',
                'lang_name' => 'Payments'
            ],
            [
                'name' => 'showPaymentTypes',
                'lang_name' => 'PaymentTypes'
            ],
            [
                'name' => 'showWarehouse',
                'lang_name' => 'Warehouse'
            ],
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
            [
                'name' => 'showSettings',
                'lang_name' => 'Settings'
            ],
            [
                'name' => 'showTelegram',
                'lang_name' => 'Telegram'
            ],
            [
                'name' => 'showReports',
                'lang_name' => 'Reports'
            ],
            [
                'name' => 'showDailyExpenses',
                'lang_name' => 'DailyExpenses'
            ],
            [
                'name' => 'showGivenMoney',
                'lang_name' => 'GivenMoney'
            ],
            [
                'name' => 'showPayingEmployees',
                'lang_name' => 'PayingEmployees'
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
