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

         \App\Models\User::factory()->create([
             'name' => 'Super admin',
             'login' => 'admin',
             'password' =>  Hash::make('560605860608') , // avvalgisi 121212
             'position' => 'Admin',
             'role' => 'admin'
         ]);
        $this->call([
            PaymentTypeSeeder::class,
            ServiceCategorySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminAddPermissionSeeder::class
        ]);
    }
}
