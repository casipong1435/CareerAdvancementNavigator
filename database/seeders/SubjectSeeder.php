<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subjects;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'area' => 'Filipino'
            ],
            [
                'area' => 'English'
            ],
            [
                'area' => 'Science'
            ],
            [
                'area' => 'Mathematics'
            ],
            [
                'area' => 'MAPEH'
            ],
            [
                'area' => 'Ar-Pan'
            ],
            [
                'area' => 'TLE'
            ],
            [
                'area' => 'ESP'
            ]
        ];

        Subjects::insert($values);
    }
}
