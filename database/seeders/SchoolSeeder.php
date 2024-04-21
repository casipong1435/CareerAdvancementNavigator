<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\school;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school_data = [
            [
                'district' => 1,
                'school_name' => 'Felipe Carreon Central School'
            ],
            [
                'district' => 1,
                'school_name' => 'Andrea Costonera Elementary School'
            ],
            [
                'district' => 1,
                'school_name' => 'Sancho Capa Elementary School'
            ],
            [
                'district' => 1,
                'school_name' => 'Ozamiz City National High School'
            ],
            [
                'district' => 2,
                'school_name' => 'Ozamiz City Central School' 
            ],
            [
                'district' => 3,
                'school_name' => 'Baybay Central School' 
            ],
            [
                'district' => 3,
                'school_name' => 'Catadman Elementary School' 
            ],
            [
                'district' => 3,
                'school_name' => 'Sta. Cruz Elementary School' 
            ],
            [
                'district' => 3,
                'school_name' => 'Misamis Annex Integrated School' 
            ],
            [
                'district' => 4,
                'school_name' => 'Maningcol Central School' 
            ],
            [
                'district' => 4,
                'school_name' => 'Doña Consuelo Elementary School' 
            ],
            [
                'district' => 4,
                'school_name' => 'Gango Elementary School' 
            ],
            [
                'district' => 4,
                'school_name' => 'Ozamiz City School of Arts and Trade' 
            ],
            [
                'district' => 4,
                'school_name' => 'San Antonio National High School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Labo Central School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Embargo Elementary School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Domingo A. Barloa Elementary School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Gotocan Elementary School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Sangay Elementary School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Mintalar Elementary School' 
            ],
            [
                'district' => 5,
                'school_name' => 'Labo National High School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Maximino S. Laurente, Sr. Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Anteno D. Hinagdanan Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Dalapang Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Faustino C. Decena Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Hilarion A. Ramiro Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Roman A. Mabanag, Sr. Elementary School' 
            ],
            [
                'district' => 6,
                'school_name' => 'Jose Lim Ho National High School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Antero U. Roa Central School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Capucao C Elementary School'
            ],
            [
                'district' => 7,
                'school_name' => 'Capucao Elementary School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Guingona Elementary School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Pershing Tan Queto, Sr. Elementary School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Tipan Elementary School' 
            ],
            [
                'district' => 7,
                'school_name' => 'Montol National High School' 
            ],
            [
                'district' => 8,
                'school_name' => 'Juan A. Acapulco Elementary School' 
            ],
            [
                'district' => 8,
                'school_name' => 'Gala Elementary School' 
            ],
            [
                'district' => 8,
                'school_name' => 'Guimad Elementary School' 
            ],
            [
                'district' => 8,
                'school_name' => 'Marcilino C. Regis Integrated School' 
            ],
            [
                'district' => 8,
                'school_name' => 'Cogon Integrated School'
            ],
            [
                'district' => 8,
                'school_name' => 'Gala National High School'
            ],
            [
                'district' => 9,
                'school_name' => 'Balintawak Elementary School'
            ],
            [
                'district' => 9,
                'school_name' => 'Cruz Lanzano Saligan Elementary School'
            ],
            [
                'district' => 9,
                'school_name' => 'Dimaluna Elementary School'
            ],
            [
                'district' => 9,
                'school_name' => 'Pulot Elementary School'
            ],
            [
                'district' => 9,
                'school_name' => 'Malaubang Integrated School'
            ],
            [
                'district' => 10,
                'school_name' => 'Narciso B. Ledesma Central School'
            ],
            [
                'district' => 10,
                'school_name' => 'Gregorio A Saquin Elementary School'
            ],
            [
                'district' => 10,
                'school_name' => 'Diego Tuastomban Elementary School'
            ],
            [
                'district' => 10,
                'school_name' => 'Sinusa Elementary School'
            ],
            [
                'district' => 10,
                'school_name' => 'Labinay Elementary School'
            ],
            [
                'district' => 10,
                'school_name' => 'Jacinto Nemeño Integrated School'
            ],
            [
                'district' => 10,
                'school_name' => 'Labinay National High School'
            ],
            [
                'district' => 10,
                'school_name' => 'Tabid National High School'
            ],
            [
                'district' => 10,
                'school_name' => 'Ozamiz City National High School'
            ],
        ];

        school::insert($school_data);
    }
}
