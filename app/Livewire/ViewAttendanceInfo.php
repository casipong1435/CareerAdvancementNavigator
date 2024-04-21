<?php

namespace App\Livewire;
use App\Models\attendance;
use App\Models\User;
use App\Models\OfficialTraining;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class ViewAttendanceInfo extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $position = null;
    public $sex = null;
    public $district = null;
    public $training_id;

    public $from;
    public $to;

    public function mount($training_id){
        $this->training_id = $training_id;
    }

    public function render()
    {
        $training_info = OfficialTraining::where('training_id', $this->training_id)->first(['start_of_conduct', 'end_of_conduct']);

        $user_attended = User::join('profiles', 'users.employee_id', 'profiles.employee_id')
                                    ->join('attendances', 'users.employee_id', 'attendances.employee_id')
                                    ->where('training_id', $this->training_id)
                                    ->where(function($query){
                                        $query->search('users.employee_id', $this->search_input)
                                        ->search('profiles.first_name', $this->search_input)
                                        ->search('profiles.last_name', $this->search_input)
                                        ->search('profiles.sex', $this->search_input)
                                        ->search('users.position', $this->search_input)
                                        ->search('profiles.district', $this->search_input)
                                        ->search('attendances.logged_in', $this->search_input)
                                        ->search('school', $this->search_input);
                                           
                                    })
                                    ->when($this->position, function($query){
                                        $query->where('users.position', $this->position);
                                     })->when($this->sex, function($query){
                                         $query->where('profiles.sex', $this->sex);
                                     })->when($this->district, function($query){
                                        $query->where('profiles.district', $this->district);
                                    })
                                     ->orderBy('logged_in', $this->sortBy)
                                     ->get(['attendances.employee_id','first_name', 'last_name', 'age', 'district', 'logged_in','position', 'sex', 'school']);

        return view('livewire.admin.view-attendance-info', ['user_attended' => $user_attended, 'training_info' => $training_info]);
    }

    public function generateReport(){

        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        try{
            $attendance_count = User::join('profiles', 'users.employee_id', 'profiles.employee_id')
            ->join('attendances', 'users.employee_id', 'attendances.employee_id')
            ->where('training_id', $this->training_id)
            ->where('date_attended', '>=', $this->from)
            ->where('date_attended', '<=', $this->to)
            ->count();

            if($attendance_count > 0){
                session()->flash('found-report', 'Found '.$attendance_count.' User Attended!');
            }else{
                session()->flash('fail', 'Found '.$attendance_count.' User Attended!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
