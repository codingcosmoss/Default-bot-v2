<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use App\Traits\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            'name' => 'Naqt',
            'status' => Status::$status_active,
        ]);
    }
}
