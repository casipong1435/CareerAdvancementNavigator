<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Profiles;
use App\Models\SubjectArea;
use App\Models\Subjects;
use App\Models\CareerService;
use App\Models\GradeLevelTaught;
use App\Models\GradeLevels;
use App\Models\school;
use App\Models\EducationalAttainment;
use App\Models\PositionCategory;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class Profile extends Component
{
    public $today;
    public $employee_id;

    public $accountSetting = 0;
    public $state = 0;
    public $show = false;

    public $first_name;
    public $last_name;
    public $middle_name;
    public $category = '';
    public $position = '';
    public $district = '';
    public $school = '';
    
    public $date_started_in_deped;
    public $years_in_service;
    public $salary_grade;
    public $salary;
    public $mobile_number;
    public $date_of_birth;
    public $age;
    public $sex;
    public $email;
    public $pwd;

    public $password;
    public $new_password;
    public $confirm_password;

    public $image;

    public $career_description;
    public $career_from;
    public $career_to;

    public $education_description_doctorate;
    public $doctorate_from;
    public $doctorate_to;

    public $education_description_masteral;
    public $masteral_from;
    public $masteral_to;

    public $education_description_others;
    public $others_from;
    public $others_to;

    public $education_description_baccalaureate;
    public $baccalaureate_from;
    public $baccalaureate_to;

    public $subject_description = '';
    public $subject_from;

    public $grade_level = '';
    public $grade_level_from;
    public $grade_level_to;

    public function mount(){
        $this->employee_id = auth()->user()->employee_id;
        $this->today = Carbon::now('Asia/Manila')->toDateString();
        $this->GetInfo();
    }

    public function render()
    {
        
        $subject_lists = Subjects::get();
        $subject_area = SubjectArea::where('employee_id', $this->employee_id)->get();
        $career_service = CareerService::where('employee_id', $this->employee_id)->get();
        $educational_attainment_baccalaureate = EducationalAttainment::where('employee_id', $this->employee_id)->where('level', 1)->get();
        $educational_attainment_masteral = EducationalAttainment::where('employee_id', $this->employee_id)->where('level', 2)->get();
        $educational_attainment_doctoral = EducationalAttainment::where('employee_id', $this->employee_id)->where('level', 3)->get();
        $educational_attainment_others = EducationalAttainment::where('employee_id', $this->employee_id)->where('level', 0)->get();
        $grade_level_taught = GradeLevelTaught::where('employee_id', $this->employee_id)->get();
        $grade_level_list = GradeLevels::get();

        $district_list = school::distinct()->get('district');

        $school_values = school::when($this->district, function($query){
            $query->where('district', $this->district);
        })
        ->get('school_name');


        return view('livewire.user.profile', ['subject_area' => $subject_area, 'career_service' => $career_service, 'educational_attainment_others' => $educational_attainment_others, 'educational_attainment_baccalaureate' => $educational_attainment_baccalaureate ,'educational_attainment_masteral' => $educational_attainment_masteral, 'educational_attainment_doctoral' => $educational_attainment_doctoral, 'school_values' => $school_values, 'district_list' => $district_list, 'subject_lists' => $subject_lists, 'grade_level_taught' => $grade_level_taught, 'grade_level_list' => $grade_level_list]);
    }

    public function GetInfo(){
        
        $employee_info = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                                    ->leftJoin('salary_grades', 'users.position', '=', 'salary_grades.position')
                                    ->where('users.employee_id', $this->employee_id)->first();

        $this->category = $employee_info->category;
        $this->position = $employee_info->position;
        $this->first_name = ucfirst($employee_info->first_name);
        $this->last_name = ucfirst($employee_info->last_name);
        $this->middle_name = ucfirst($employee_info->middle_name);
        $this->date_of_birth = $employee_info->date_of_birth;
        $this->age = $employee_info->age;
        $this->sex = $employee_info->sex;
        $this->email = $employee_info->email;
        $this->mobile_number = $employee_info->mobile_number;
        $this->date_started_in_deped = $employee_info->date_started_in_deped;
        $this->district = $employee_info->district;
        $this->school = $employee_info->school;
        $this->years_in_service = $employee_info->years_in_service;
        $this->image = $employee_info->image;
        $this->salary_grade = $employee_info->salaryID;
        $this->salary = $employee_info->salary;
        $this->password = $employee_info->plain_pass;
        $employee_info->pwd ? $this->pwd = $employee_info->pwd: $this->pwd = '';
    }

    public function addMoreData($table){
        switch ($table){
            case 0:
                    $this->validate([
                        'subject_description' => 'required',
                        'subject_from' => 'required'
                    ]);
                        
                    try{
                        SubjectArea::create(['employee_id' => $this->employee_id, 'description' => $this->subject_description, 'from' => $this->subject_from]);
                        $this->subject_description = '';
                        $this->subject_from = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 1:
                    $this->validate([
                        'career_description' => 'required',
                        'career_from' => 'required'
                    ]);
                        
                    try{
                        CareerService::create(['employee_id' => $this->employee_id, 'description' => $this->career_description, 'from' => $this->career_from, 'to' => $this->career_to]);
                        $this->career_description = '';
                        $this->career_from = '';
                        $this->career_to = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 2:
                    $this->validate([
                        'grade_level' => 'required',
                        'grade_level_from' => 'required'
                    ]);
                        
                    try{
                        GradeLevelTaught::create(['employee_id' => $this->employee_id, 'grade_level' => $this->grade_level, 'from' => $this->grade_level_from, 'to' => $this->grade_level_to]);
                        $this->grade_level = '';
                        $this->grade_level_from = '';
                        $this->grade_level_to = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
        }
    }

    public function addEducation($level){
        switch($level){
            case 0:
                    $this->validate([
                        'education_description_others' => 'required',
                        'others_from' => 'required',
                        'others_to' => 'required'
                    ]);

                    try{
                        EducationalAttainment::create(['employee_id' => $this->employee_id, 'level' => $level, 'from' => $this->others_from, 'to' => $this->others_to, 'description' => $this->education_description_others]);
                        $this->education_description_others = '';
                        $this->others_from = '';
                        $this->others_to = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 1:
                    $this->validate([
                        'education_description_baccalaureate' => 'required',
                        'baccalaureate_from' => 'required',
                        'baccalaureate_to' => 'required'
                    ]);

                    try{
                        EducationalAttainment::create(['employee_id' => $this->employee_id, 'level' => $level, 'from' => $this->baccalaureate_from, 'to' => $this->baccalaureate_to, 'description' => $this->education_description_baccalaureate]);
                        $this->education_description_baccalaureate = '';
                        $this->baccalaureate_from = '';
                        $this->baccalaureate_to = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 2:
                    $this->validate([
                        'education_description_masteral' => 'required',
                        'masteral_from' => 'required',
                        'masteral_to' => 'required'
                    ]);

                    try{
                        EducationalAttainment::create(['employee_id' => $this->employee_id, 'level' => $level, 'from' => $this->masteral_from, 'to' => $this->masteral_to, 'description' => $this->education_description_masteral]);
                        $this->education_description_masteral = '';
                        $this->masteral_from = '';
                        $this->masteral_to = '';
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 3:
                $this->validate([
                    'education_description_doctorate' => 'required',
                    'doctorate_from' => 'required',
                    'doctorate_to' => 'required'
                ]);

                try{
                    EducationalAttainment::create(['employee_id' => $this->employee_id, 'level' => $level, 'from' => $this->doctorate_from, 'to' => $this->doctorate_to, 'description' => $this->education_description_doctorate]);
                    $this->education_description_doctorate = '';
                    $this->doctorate_from = '';
                    $this->doctorate_to = '';
                }catch(\Exception $e){
                    session()->flash('error', 'Something went wrong!!');
                }
                break;
        }
    }

    public function deleteDetails($table, $id){
        switch ($table){
            case 0:
                        
                    try{
                        SubjectArea::where('id', $id)->delete();
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 1:
                    try{
                        CareerService::where('id', $id)->delete();
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 2:
                    try{
                        EducationalAttainment::where('id', $id)->delete();
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
            case 3:
                    try{
                        GradeLevelTaught::where('id', $id)->delete();
                    }catch(\Exception $e){
                        session()->flash('error', 'Something went wrong!!');
                    }
                break;
        }
    }


    public function changeState($state){
        $this->state = $state;
        $this->GetInfo();
        //if ($state == 0) 
    }

    public function updateProfile(){
        $this->validate([
            'date_started_in_deped' => 'required',
            'mobile_number' => 'required',
            'district' => 'required',
            'school' => 'required',
            'email' => 'required|unique:users,email,'.$this->employee_id.',employee_id',
            
        ]);
        
        try{
            $years_in_service = Carbon::now()->diffInYears($this->date_started_in_deped);

            $values1 = [
                'mobile_number' => $this->mobile_number,
                'years_in_service' => $years_in_service,
                'district' => $this->district,
                'date_started_in_deped' => $this->date_started_in_deped,
                'school' => $this->school,
                'pwd' => $this->pwd
                
            ];
            
            $values2 = [
                'category' => $this->category,
                'position' => $this->position,
                'email' => $this->email
            ];
    
            Profiles::where('employee_id', $this->employee_id)->update($values1);
            User::where('employee_id', $this->employee_id)->update($values2);
            session()->flash('success', 'Profile Updated!');
            $this->state = 0;
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }
    }

    public function accountSetLink($state){
        $this->accountSetting = $state;
    }

    public function changePassword(){
    
        $this->validate([
            'password' => 'required',
            'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        try{
            $values = [
                'password' => Hash::make($this->new_password),
                'plain_pass' => $this->new_password,
            ];

            User::where('employee_id', $this->employee_id)->update($values);
            session()->flash('success', 'Password Updated!');
            $this->password = '';
            $this->new_password = '';
            $this->confirm_password = '';
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }
    }

    public function showPassword(){
        if($this->show == false){
            $this->show = true;
        }else{
            $this->show = false;
        }
    }

    
}
