<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([[
            'name' => 'PUR',
            'color' => '#5193FC',
            'user_id' => 1
        ], [
            'name' => 'Chape',
            'color' => '#9961FA',
            'user_id' => 1
        ], [
            'name' => 'Isolatie Mortel',
            'color' => '#828282',
            'user_id' => 1
        ]]);
    }
}
