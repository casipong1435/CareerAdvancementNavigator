<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PositionCategory;
use App\Models\User;
use App\Models\Profiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Registration extends Component
{
    use WithFileUploads;
    
    public $category = '';
    public $employee_id;
    public $position = '';
    public $first_name;
    public $last_name;
    public $middle_name = '';
    public $date_of_birth;
    public $sex = 'male';
    public $email;
    public $mobile_number;
    public $password;
    public $confirm_password;
    public $image;

    public function resetFields(){
        $this->employee_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->middle_name = '';
        $this->date_of_birth = '';
        $this->sex = '';
        $this->email = '';
        $this->mobile_number = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->image = '';
        $this->position = '';
    }

    public function render()
    {
        $category_values = PositionCategory::distinct()->get(['category']);

        $position_values = PositionCategory::distinct()->when($this->category, function($query){
            $query->where('category', $this->category);
        })
        ->whereNot('position', 'HR')
        ->get('position');

        return view('livewire.registration', ['category_values' => $category_values, 'position_values' => $position_values]);
    }

    public function RegisterUser(){
        $this->validate([
            "position" => 'required',
            "employee_id" => 'required|numeric|unique:users,employee_id|min:3',
            "first_name" => 'required',
            "middle_name" => 'nullable',
            "last_name" => 'required',
            "date_of_birth" => 'required',
            "sex" => 'required|in:male,female',
            "mobile_number" => 'required|numeric|min:12|unique:profiles,mobile_number',
            "password" => 'min:8|required_with:confirm_password|same:confirm_password',
            "confirm_password" => 'required',
            "email" => 'required|email|unique:users,email',
            "image" => 'required'
        ]);

        $file_explode = $this->image;
        //$file_replace = str_replace($this->image, 'data:image/jpeg;base64,');
        $folderPath = public_path().'/assets/images/';
        $fileName = uniqid() . '.jpeg';

        $file = $folderPath . $fileName;

        try{
            $age = Carbon::now()->diffInYears($this->date_of_birth);
            $values1 = [
                'employee_id' => $this->employee_id,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'date_of_birth' => $this->date_of_birth,
                'age' => $age,
                'sex' => $this->sex,
                'mobile_number' => $this->mobile_number,
                'image' => $fileName

            ];
            
            

            $values2 = [
                'employee_id' => $this->employee_id,
                'password' => Hash::make($this->password),
                'plain_pass' => $this->password,
                'category' => $this->category,
                'position' => $this->position,
                'email' => $this->email,
                'role' => 0,
                'status' => 0,
                'job_status' => 1
            ];

            Profiles::create($values1);
            User::create($values2);
            file_put_contents($file, base64_decode($file_explode));
            session()->flash('success', 'Registration Successful!');
            $this->resetFields();
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }
    }
}
