<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ExpenseCategory;
use App\Traits\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = Clinic::all();
        foreach ($clinics as $clinic){
            $isCategory = ExpenseCategory::where('clinic_id', $clinic->id)->first();
            if (!$isCategory){
                ExpenseCategory::create([
                    'clinic_id' => $clinic->id,
                    'name' => 'Refunds',
                    'type' => Status::$default,
                    'description' => 'Money returned to the customer',
                ]);
            }
        }

    }
}
