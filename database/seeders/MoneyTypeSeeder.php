<?php

namespace Database\Seeders;

use App\Models\MoneyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MoneyType::create([
            'name' => "Sum",
            'sign' => "sum",
        ]);
        MoneyType::create([
            'name' => "Dollar",
            'sign' => "rubl",
        ]);
    }
}
