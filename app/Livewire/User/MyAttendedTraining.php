<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\AttendedTraining;
use Auth;

class MyAttendedTraining extends Component
{

    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public $employee_id;

    public $from;
    public $to;

    public function mount(){
        $this->employee_id = Auth::user()->employee_id;
    }

    public function render()
    {
        
        $attended_trainings = AttendedTraining::leftJoin('official_trainings','attended_trainings.training_id', '=','official_trainings.training_id')
                        ->where(function($query){
                            $query->search('training_title', $this->search_input)
                            ->search('official_trainings.training_id', $this->search_input)
                            ->search('number_of_hours', $this->search_input)
                            ->search('start_of_conduct', $this->search_input)
                            ->search('end_of_conduct', $this->search_input);
                        })
                        ->where('attended_trainings.employee_id', $this->employee_id)
                        ->orderBy($this->orderBy, $this->sortBy)->get();
        
        return view('livewire.user.my-attended-training', ['attended_trainings' => $attended_trainings]);
    }

    public function generateReport(){

        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        try{
            $attended_trainings = AttendedTraining::leftJoin('official_trainings','attended_trainings.training_id', '=','official_trainings.training_id')
                        ->where('start_of_conduct', '>=', $this->from)
                        ->where('start_of_conduct', '<=', $this->to)
                        ->where('attended_trainings.employee_id', $this->employee_id)
                        ->count();

            if($attended_trainings > 0){
                session()->flash('found-report', 'Found '.$attended_trainings.' Training!');
            }else{
                session()->flash('fail', 'Found '.$attended_trainings.' Training!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
