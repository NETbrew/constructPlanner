<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('works')->insert([[
            'title' => 'Project A',
            'location' => 'straat A',
            'telephone' => '123-456-7890',
            'email' => 'projectA@example.com',
            'squaremeters' => 150.5,
            'date' => '2024-02-01',
            'note' => 'This is a note for Project A.',
            'user_id' => 1,
            'type_id' => 1,
        ],
            [
                'title' => 'Project B',
                'location' => 'City Y',
                'telephone' => '987-654-3210',
                'email' => 'projectB@example.com',
                'squaremeters' => 200.0,
                'date' => '2024-02-01',
                'note' => 'This is a note for Project B.',
                'user_id' => 1,
                'type_id' => 2,
            ],
            [
                'title' => 'Project C',
                'location' => 'City Z',
                'telephone' => '555-123-4567',
                'email' => 'projectC@example.com',
                'squaremeters' => 120.8,
                'date' => '2024-02-2',
                'note' => 'This is a note for Project C.',
                'user_id' => 1,
                'type_id' => 3,
            ],[
                'title' => 'Project D',
                'location' => 'straat D',
                'telephone' => '123-456-7890',
                'email' => 'projectA@example.com',
                'squaremeters' => 150.5,
                'date' => '2024-02-3',
                'note' => 'This is a note for Project A.',
                'user_id' => 1,
                'type_id' => 1,
            ],
            [
                'title' => 'Project E',
                'location' => 'City E',
                'telephone' => '987-654-3210',
                'email' => 'projectB@example.com',
                'squaremeters' => 200.0,
                'date' => '2024-02-04',
                'note' => 'This is a note for Project B.',
                'user_id' => 1,
                'type_id' => 2,
            ],
            [
                'title' => 'Project F',
                'location' => 'City F',
                'telephone' => '555-123-4567',
                'email' => 'projectC@example.com',
                'squaremeters' => 120.8,
                'date' => '2024-02-05',
                'note' => 'This is a note for Project C.',
                'user_id' => 1,
                'type_id' => 3,
            ],[
                'title' => 'Project G',
                'location' => 'straat G',
                'telephone' => '123-456-7890',
                'email' => 'projectA@example.com',
                'squaremeters' => 150.5,
                'date' => '2024-02-06',
                'note' => 'This is a note for Project A.',
                'user_id' => 1,
                'type_id' => 1,
            ],
            [
                'title' => 'Project H',
                'location' => 'City H',
                'telephone' => '987-654-3210',
                'email' => 'projectB@example.com',
                'squaremeters' => 200.0,
                'date' => '2024-02-07',
                'note' => 'This is a note for Project B.',
                'user_id' => 1,
                'type_id' => 2,
            ],
            [
                'title' => 'Project I',
                'location' => 'City I',
                'telephone' => '555-123-4567',
                'email' => 'projectC@example.com',
                'squaremeters' => 120.8,
                'date' => '2024-02-7',
                'note' => 'This is a note for Project C.',
                'user_id' => 1,
                'type_id' => 3,
            ],]);
    }
}
