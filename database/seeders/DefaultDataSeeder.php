<?php

namespace Database\Seeders;

use App\Models\BoxSize;
use App\Models\Clinic;
use App\Models\Currency;
use App\Models\DrugCompany;
use App\Models\MedicineCategory;
use App\Models\PaymentType;
use App\Models\Setting;
use App\Models\SizeType;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Traits\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
   

            Setting::create([
                'name' => 'Pharma plus',
                'address' => 'Uzbekistan',
                'phone' => '+(998) 993645621',
                'currency_id' => Currency::first()->id,
                'clinic_id' => $clinic->id,
            ]);

        }


    }
}
