<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionSeeder::class,
            ExpenseCategorySeeder::class,
            AddPrivateRoleAllUsersSeeder::class,
        ]);
    }
}
