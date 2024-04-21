<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AttendedTraining;
use App\Models\OfficialTraining;

class ListOfParticipant extends Component
{

    public $training_id;

    public $search_input = "";
    public $sortBy = "asc";
    public $position = null;
    public $sex = null;
    public $district = null;

    public function mount($training_id){
        $this->training_id = $training_id;
    }

    public function render()
    {
        $training_info = OfficialTraining::where('training_id', $this->training_id)->first();

        $user_attended = AttendedTraining::leftJoin('users', 'attended_trainings.employee_id', '=', 'users.employee_id')
                                        ->leftJoin('profiles', 'attended_trainings.employee_id', '=', 'profiles.employee_id')
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
                                         ->orderBy('users.employee_id', $this->sortBy)
                                        ->where('training_id', $this->training_id)->get();
        return view('livewire.admin.list-of-participant', ['training_info' => $training_info, 'user_attended' => $user_attended]);
    }
}
