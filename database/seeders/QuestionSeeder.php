<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\GadAssessmentQuestion;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'description' => 'Gender Sensitivity Orientation',
                'year' => 2024
            ],
            [
                
                'description' => 'Seminar on Gender and Sexuality/Gender Awareness Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Concepts Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Gender-Fair Education Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Seminar on Teenage Pregnancy',
                'year' => 2024
            ],
            [
                
                'description' => 'Reproductive Health Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'HIV Awareness Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'HIV, Tubercilosis and Hepatitis Awareness and Prevention Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Young Adolescence Fertility and Sexuality Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Breast Cancer Awareness Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Human Rights Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Pressure and Stress Management Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Mental Health Awareness Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Child Sexual Abuse Prevention Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'Work Ethics and Anti-Sexual Harrassment Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: R.A. 9710 - Magna Carta of Women',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: R.A. 7877 - Anti-Sexual Harassment Act of 1995',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: R.A. 9262 - Anti-Violence Against Women and their Children Act of 2004',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: R.A. 9208 - Anti-Trafficking in Persons Act',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: R.A. 11313 - Safe Spaces Act (Bawal Bastos Law)',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: Gender-Responsive Extension and Research Seminar',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: Gender and Responsive Planning and Budgeting',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: Gender Concepts and Gender Analysis (GA) Tools Gender Sensitivity Training',
                'year' => 2024
            ],
            [
                
                'description' => 'GAD Laws and Mandates: Use of GAD Tools (e.g. HGDG) for Gender Analysis',
                'year' => 2024
            ],
        ];

        GadAssessmentQuestion::insert($values);
    }
}
