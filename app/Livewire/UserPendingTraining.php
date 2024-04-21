<?php

namespace App\Livewire;
use App\Models\PendingTraining;
use Auth;

use Livewire\Component;

class UserPendingTraining extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public function render()
    {
        $employee_id = Auth::user()->employee_id;

        $pending_trainings = PendingTraining::where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('training_id', $this->search_input)->where('status', 0)
                                ->search('number_of_hours', $this->search_input)->where('status', 0)
                                ->search('start_of_conduct', $this->search_input)->where('status', 0)
                                ->search('end_of_conduct', $this->search_input)->where('status', 0);
                            })
                            ->where('employee_id', $employee_id)
                            ->orderBy($this->orderBy, $this->sortBy)->get();

        return view('livewire.user.user-pending-training', ['pending_trainings' => $pending_trainings]);
    }
}