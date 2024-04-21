<?php

namespace App\Livewire\User;

use App\Models\OfficialTraining;
use App\Models\SelectedParticipant;
use App\Models\attendance;
use App\Models\AttendedTraining;

use Carbon\Carbon;
use Livewire\Component;

class MyOngoingTraining extends Component
{
    public $employee_id;
    public $today;

    public $selecteduser_search_input = "";
    public $selecteduser_sortBy = "asc";
    public $selecteduser_sex;
    public $selecteduser_orderBy = 'first_name';

    public $start_date = 0;
    public $end_date = 0;
    public $number_of_days = 0;

    public $training_id;

    public function mount(){
        $this->employee_id = auth()->user()->employee_id;
        $this->today = Carbon::now('Asia/Manila');
    }

    public function render()
    {
        $ongoing_training = OfficialTraining::leftJoin('selected_participants', 'official_trainings.training_id', '=', 'selected_participants.training_id')
                                ->where('status', 0)
                                ->where('start_of_conduct', '<=', $this->today)
                                ->where('employee_id', $this->employee_id)
                                ->first();

        if ($ongoing_training){
            $this->training_id = $ongoing_training->training_id;
            $this->start_date = Carbon::parse($ongoing_training->start_of_conduct);
            $this->end_date = Carbon::parse($ongoing_training->end_of_conduct);
            
            $this->number_of_days = $this->start_date->diffInDays($this->end_date) + 1;

            $attended_training = AttendedTraining::where('training_id', $this->training_id)
                            ->where('employee_id', $this->employee_id)
                            ->first();

            $attendance = attendance::where('employee_id', $this->employee_id)->where('training_id', $this->training_id)->get();

            $selected_participant = SelectedParticipant::leftJoin('users', 'selected_participants.employee_id', '=', 'users.employee_id')
                                ->leftJoin('profiles', 'selected_participants.employee_id', '=', 'profiles.employee_id')
                                ->where(function($query){
                                    $query->search('users.employee_id', $this->selecteduser_search_input)
                                        ->search('profiles.first_name', $this->selecteduser_search_input)
                                        ->search('profiles.age', $this->selecteduser_search_input)
                                        ->search('profiles.sex', $this->selecteduser_search_input);
                                })
                                ->when($this->selecteduser_sex, function($query){
                                    $query->where('profiles.sex', $this->selecteduser_sex);
                                })
                                ->orderBy($this->selecteduser_orderBy, $this->selecteduser_sortBy)
                                ->where('users.role', 0)
                                ->where('selected_participants.training_id', $this->training_id)
                                ->get();
        }else{
            $selected_participant = null;
            $attended_training = null;
            $attendance = null;
        }

        return view('livewire.user.my-ongoing-training', ['ongoing_training' => $ongoing_training, 'selected_participant' => $selected_participant, 'attended_training' => $attended_training, 'attendance' => $attendance]);
    }

    public function FininshTrainingAttendance(){
        $values = [
            'training_id' => $this->training_id,
            'employee_id' => $this->employee_id,
        ];

        AttendedTraining::create($values);
    }
}
