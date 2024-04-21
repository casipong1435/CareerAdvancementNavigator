<?php

namespace App\Livewire;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use Livewire\Component;
use Carbon\Carbon;

class ConductedTraining extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public $from;
    public $to;

    public function render()
    {

         $conducted_trainings = OfficialTraining::where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('number_of_hours', $this->search_input)
                                ->search('start_of_conduct', $this->search_input)
                                ->search('end_of_conduct', $this->search_input);
                            })
                            ->orderBy($this->orderBy, $this->sortBy)
                            ->whereIn('conducted_by', ['SGOD', 'CID', 'OSDS'])
                            ->get();

        return view('livewire.admin.conducted-training', ['conducted_trainings' => $conducted_trainings]);
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
