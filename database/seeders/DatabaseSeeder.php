<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Super admin',
//             'login' => 'admin',
//             'password' =>  Hash::make('121212') ,
//             'position' => 'Admin'
//         ]);
        $this->call([
//            PaymentTypeSeeder::class,
//            ServiceCategorySeeder::class,
            PermishshenSeeder::class
        ]);
    }
}
