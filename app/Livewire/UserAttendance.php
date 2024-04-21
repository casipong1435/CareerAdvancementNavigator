<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\attendance;
use App\Models\AttendedTraining;

use Carbon\Carbon;


class UserAttendance extends Component
{
    public $training_id;
    public $employee_id;

    public function mount($training_id){
        $this->training_id = $training_id;
        $this->employee_id = auth()->user()->employee_id;
    }

    public function render()
    {
        
        $attended_training = AttendedTraining::where('training_id', $this->training_id)
                            ->where('employee_id', $this->employee_id)
                            ->first();

        $training_info = OfficialTraining::where('training_id', $this->training_id)->first();
        $attendance = attendance::where('employee_id', $this->employee_id)->where('training_id', $this->training_id)->get();

        $start_date = Carbon::parse($training_info->start_of_conduct);
        $end_date = Carbon::parse($training_info->end_of_conduct);
        
        $number_of_days = $start_date->diffInDays($end_date) + 1;

        return view('livewire.user.user-attendance', ['training_info' => $training_info, 'attendance' => $attendance, 'number_of_days' => $number_of_days, 'attended_training' => $attended_training]);
    }

    public function FininshTrainingAttendance(){
        $values = [
            'training_id' => $this->training_id,
            'employee_id' => $this->employee_id,
        ];

        AttendedTraining::create($values);
    }
}
