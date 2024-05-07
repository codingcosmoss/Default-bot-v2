<?php

namespace Database\Seeders;

use App\Models\Phrase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhraseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phrase::create([
            'name' => 'Darak gap'
        ]);
        Phrase::create([
            'name' => "So'roq gap"
        ]);
        Phrase::create([
            'name' => "Buyruq gap"
        ]);
        Phrase::create([
            'name' => "Istak gap"
        ]);
        Phrase::create([
            'name' => "His hayajon gap"
        ]);
    }
}
