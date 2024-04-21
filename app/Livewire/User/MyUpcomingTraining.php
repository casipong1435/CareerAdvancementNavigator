<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\SelectedParticipant;
use Auth;

use Carbon\Carbon;

class MyUpcomingTraining extends Component
{

    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public $today;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render()
    {
        $employee_id = Auth::user()->employee_id;

        $upcoming_training = SelectedParticipant::leftJoin('official_trainings','selected_participants.training_id', '=','official_trainings.training_id')
                        ->where(function($query){
                            $query->search('training_title', $this->search_input)
                            ->search('official_trainings.training_id', $this->search_input)
                            ->search('number_of_hours', $this->search_input)
                            ->search('start_of_conduct', $this->search_input)
                            ->search('end_of_conduct', $this->search_input);
                        })
                        ->where('selected_participants.employee_id', $employee_id)
                        ->where('start_of_conduct', '>', $this->today)
                        ->orderBy($this->orderBy, $this->sortBy)->get();
        
        return view('livewire.user.my-upcoming-training', ['upcoming_training' => $upcoming_training]);
    }
}
