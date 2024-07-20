<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
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
        $this->call([
//            ClinicSeeder::class,
//            ClinicUserSeeder::class,
//            UserSeeder::class,
            PermissionSeeder::class,
//            RoleSeeder::class,
//        ExpenseCategorySeeder::class,
//        CurrencySeeder::class
        ]);
    }
}
