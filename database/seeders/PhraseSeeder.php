<?php

namespace Database\Seeders;

use App\Models\Phrase;
use App\Traits\Status;
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
            'name' => 'Darak gap',
            'type' => Status::$tree
        ]);
        Phrase::create([
            'name' => "So'roq gap",
            'type' => Status::$question
        ]);
        Phrase::create([
            'name' => "Buyruq gap",
            'type' => Status::$command
        ]);
        Phrase::create([
            'name' => "Istak gap",
            'type' => Status::$desire
        ]);
        Phrase::create([
            'name' => "His hayajon gap",
            'type' => Status::$feelingExcited
        ]);
    }
}
