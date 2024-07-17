<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ExpenseCategory;
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
                    'name' => 'General',
                    'description' => 'General expenses are in this category',
                ]);
            }
        }

    }
}
