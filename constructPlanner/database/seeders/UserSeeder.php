<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'example bedrijf',
            'email' => 'mail@fake.be',
            'password' => Hash::make('admin123')
        ],[
            'name' => 'César',
            'email' => 'cesar@fake.be',
            'password' => Hash::make('admin')
        ]]);
    }
}
