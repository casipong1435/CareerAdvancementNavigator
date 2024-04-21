<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradeLevels;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'grade_level' => 'K1'
            ],
            [
                'grade_level' => 'K2'
            ],
            [
                'grade_level' => 'G1'
            ],
            [
                'grade_level' => 'G2'
            ],
            [
                'grade_level' => 'G3'
            ],
            [
                'grade_level' => 'G4'
            ],
            [
                'grade_level' => 'G5'
            ],
            [
                'grade_level' => 'G6'
            ],
            [
                'grade_level' => 'G6'
            ],
            [
                'grade_level' => 'ALS'
            ],
            [
                'grade_level' => 'G7'
            ],
            [
                'grade_level' => 'G8'
            ],
            [
                'grade_level' => 'G9'
            ],
            [
                'grade_level' => 'G10'
            ],
            [
                'grade_level' => 'G11'
            ],
            [
                'grade_level' => 'G12'
            ]
        ];

        GradeLevels::insert($values);
    }
}
