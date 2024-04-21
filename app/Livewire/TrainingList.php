<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use Carbon\Carbon;

class TrainingList extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public $from;
    public $to;

    public function render()
    {

         $official_trainings = OfficialTraining::where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('training_id', $this->search_input)
                                ->search('number_of_hours', $this->search_input)
                                ->search('start_of_conduct', $this->search_input)
                                ->search('end_of_conduct', $this->search_input);
                            })
                            ->orderBy($this->orderBy, $this->sortBy)
                            ->where('status', 1)
                            ->get();

        return view('livewire.admin.training-list', ['official_trainings' => $official_trainings]);
    }

    public function generateReport(){

        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        try{
            $training_count = OfficialTraining::where('start_of_conduct', '>=', $this->from)->where('start_of_conduct', '<=', $this->to)->where('status', 1)->count();
            if($training_count > 0){
                session()->flash('found', 'Found '.$training_count.' Training!');
            }else{
                session()->flash('fail', 'Found '.$training_count.' Training!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
