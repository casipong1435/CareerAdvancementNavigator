<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profiles;

use Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $user = [
            'employee_id' => '12345',
            'role' => 0,
            'category' => 'Teaching',
            'position' => 'T1',
            'status' => 1,
            'password' => Hash::make('123456789'),
            'plain_pass' => '123456789'
        ];
        
        User::insert($user);

    }
}
