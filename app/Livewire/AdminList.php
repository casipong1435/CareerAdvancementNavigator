<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\Profiles;
use App\Models\PositionCategory;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

use Carbon\Carbon;

class AdminList extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $position = null;
    public $sex = null;
    public $job_status = null;

    public $newposition = '';

    public $employee_id;
    public $first_name;
    public $last_name;
    public $middle_name = '';
    public $date_of_birth;
    public $newsex = 'male';
    public $password;
    public $confirm_password;

    public function render()
    {

         $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($this->position, function($query){
                               $query->where('users.position', $this->position);
                            })->when($this->sex, function($query){
                                $query->where('profiles.sex', $this->sex);
                            })
                            ->when($this->job_status, function($query){
                                $query->where('users.job_status', $this->job_status);
                                
                            })->where(function($query){
                                $query->search('users.employee_id', $this->search_input)
                                ->search('users.employee_id', $this->search_input)
                                ->search('profiles.first_name', $this->search_input)
                                ->search('profiles.last_name', $this->search_input)
                                ->search('profiles.sex', $this->search_input)
                                ->search('users.position', $this->search_input);
                            })
                            ->orderBy('users.employee_id', $this->sortBy)
                            ->where('users.status', 1)
                            ->where('users.role', 1)
                            ->get();



            $position_values = PositionCategory::distinct()
                                                ->where('position', 'HR')
                                                ->get('position');

        return view('livewire.admin.admin-list', ['employees' => $employees, 'position_values' => $position_values]);
    }

    public function resetFields(){
        $this->employee_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->middle_name = '';
        $this->date_of_birth = '';
        $this->newsex = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->newposition = '';
    }

    public function addUser(){
        $this->validate([
            "newposition" => 'required',
            "employee_id" => 'required|unique:users,employee_id|min:3',
            "first_name" => 'required',
            "middle_name" => 'nullable',
            "last_name" => 'required',
            "date_of_birth" => 'required',
            "newsex" => 'required|in:male,female',
            "password" => 'min:8|required_with:confirm_password|same:confirm_password',
            "confirm_password" => 'required',
        ]);

        try{
            $age = Carbon::now()->diffInYears($this->date_of_birth);

            $values1 = [
                'employee_id' => $this->employee_id,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'date_of_birth' => $this->date_of_birth,
                'age' => $age,
                'sex' => $this->newsex,
            ];
            
            

            $values2 = [
                'employee_id' => $this->employee_id,
                'password' => Hash::make($this->password),
                'plain_pass' => $this->password,
                'category' => 'Teaching Related',
                'position' => $this->newposition,
                'role' => 1,
                'status' => 1
            ];

            Profiles::create($values1);
            User::create($values2);
            $this->dispatch('hide_modal');
            session()->flash('success', 'User Added!');
            $this->resetFields();
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }


    }
}
