<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Profiles;
use App\Models\PositionCategory;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class Accountlist extends Component
{

    public $search_input = "";
    public $sortBy = "asc";
    public $position = null;
    public $category = null;
    public $sex = null;
    public $job_status = null;

    public $newcategory = '';
    public $newposition = '';

    public $employee_id;
    public $first_name;
    public $last_name;
    public $middle_name = '';
    public $date_of_birth;
    public $newsex = 'male';
    public $password;
    public $confirm_password;

    public $report_position = null;
    public $report_category = null;
    public $report_sex = null;

    public $data;
    public $user_job_status;
    public $name;

    public function render()
    {

         $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($this->position, function($query){
                               $query->where('users.position', $this->position);
                            })
                            ->when($this->category, function($query){
                                $query->where('users.category', $this->category);
                             })
                            ->when($this->sex, function($query){
                                $query->where('profiles.sex', $this->sex);
                                
                            })
                            ->when($this->job_status, function($query){
                                $query->where('users.job_status', $this->job_status);
                                
                            })->where(function($query){
                                $query->search('users.employee_id', $this->search_input)
                                ->search('profiles.first_name', $this->search_input)
                                ->search('profiles.last_name', $this->search_input)
                                ->search('profiles.sex', $this->search_input)
                                ->search('users.category', $this->search_input)
                                ->search('users.position', $this->search_input);
                            })
                            ->orderBy('users.position', $this->sortBy)
                            ->where('users.status', 1)
                            ->where('users.role', 0)
                            ->get();
        
        $category_values = PositionCategory::distinct()->get(['category']);

        $position_values = PositionCategory::distinct()->when($this->newcategory, function($query){
                                $query->where('category', $this->newcategory);
                            })
                            ->whereNotIn('position', ['HR'])
                            ->get('position');

        $filtered_position_values = PositionCategory::distinct()->when($this->category, function($query){
                                $query->where('category', $this->category);
                            })
                            ->whereNotIn('position', ['HR'])
                            ->get('position');


        $report_position_values = PositionCategory::distinct()->when($this->report_category, function($query){
                                $query->where('category', $this->report_category);
                            })
                            ->whereNotIn('position', ['HR'])
                            ->get('position');

        return view('livewire.admin.accountlist', ['employees' => $employees, 'category_values' => $category_values, 'position_values' => $position_values, 'filtered_position_values' => $filtered_position_values, 'report_position_values' => $report_position_values]);
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
        $this->category = '';
        $this->newposition = '';
    }

    public function addUser(){
        $this->validate([
            "newcategory" => 'required',
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
                'category' => $this->newcategory,
                'position' => $this->newposition,
                'role' => 0,
                'status' => 1,
                'job_status' => 1
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

    public function generateReport(){
        try{
            $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($this->report_position, function($query){
                               $query->where('users.position', $this->report_position);
                            })
                            ->when($this->report_category, function($query){
                                $query->where('users.category', $this->report_category);
                             })
                            ->when($this->report_sex, function($query){
                                $query->where('profiles.sex', $this->report_sex);
                            })
                            ->where('users.status', 1)
                            ->where('users.role', 0)
                            ->count();
                            
        if($employees > 0){
            session()->flash('found-report', 'Found '.$employees.' Employee/s!');
        }else{
            session()->flash('fail', 'Found '.$employees.' Employee/s!');
        }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }

    public function resetData(){
        $this->employee_id = '';
        $this->name = '';
        $this->user_job_status = '';
    }

    public function getData($employee_id){
        $user = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                    ->where('users.employee_id', $employee_id)->first(['job_status', 'first_name', 'last_name']);

        $this->user_job_status = $user->job_status;
        $this->employee_id = $employee_id;
        $this->name = ucfirst($user->first_name).' '.ucfirst($user->last_name);
    }

    public function changeJobStatus(){
        try{
            User::where('employee_id', $this->employee_id)->update(['job_status' => $this->user_job_status]);
            $this->dispatch('hide_modal');
            session()->flash('success', 'User Status Changed!');
            $this->resetData();
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }


}
