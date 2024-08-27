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
            MedicineCategory::create([
                'name' => 'General',
                'clinic_id' => $clinic->id,
            ]);

            DrugCompany::create([
                'name' => 'Sanofi',
                'clinic_id' => $clinic->id,
            ]);
            SizeType::create([
                'name' => '100ml',
                'clinic_id' => $clinic->id,
            ]);
            BoxSize::create([
                'name' => '100ml',
                'size' => 100,
                'sign' => 'ml',
                'clinic_id' => $clinic->id,
            ]);
            Warehouse::create([
                'name' => 'Main',
                'clinic_id' => $clinic->id,
            ]);
            Supplier::create([
                'name' => 'Jon',
                'address' => 'London',
                'phone' => '+(998) 993645621',
                'clinic_id' => $clinic->id,
            ]);
            PaymentType::create([
                'name' => 'Cash payment',
                'clinic_id' => $clinic->id,
                'status' => Status::$default
            ]);
            PaymentType::create([
                'name' => 'Paypal',
                'clinic_id' => $clinic->id,
            ]);


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
