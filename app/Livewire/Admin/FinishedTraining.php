<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use Carbon\Carbon;

class FinishedTraining extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";
    public $type_of_training = "";

    public $from;
    public $to;
    public $report = '';

    public function render()
    {

         $official_trainings = OfficialTraining::where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('training_id', $this->search_input)
                                ->search('number_of_hours', $this->search_input)
                                ->search('start_of_conduct', $this->search_input)
                                ->search('end_of_conduct', $this->search_input);
                            })
                            ->when($this->type_of_training, function($query){
                                $query->where('training_type', $this->type_of_training);
                            })
                            ->orderBy($this->orderBy, $this->sortBy)
                            ->where('status', 1)
                            ->get();

        return view('livewire.admin.finished-training', ['official_trainings' => $official_trainings]);
    }

    public function generateReport(){

        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        try{
            switch ($this->report){
                case 'GAD':
                    $training_count = OfficialTraining::where('start_of_conduct', '>=', $this->from)
                                            ->where('start_of_conduct', '<=', $this->to)
                                            ->where('status', 1)
                                            ->where('training_type', 'GAD')
                                            ->count();
                    if($training_count){
                        session()->flash('found-gad', 'Found '.$training_count.' Training!');
                    }else{
                        session()->flash('fail', 'Found '.$training_count.' Training!');
                    }
                    
                    break;
                case 'Conducted':
                    $training_count = OfficialTraining::where('start_of_conduct', '>=', $this->from)
                                            ->where('start_of_conduct', '<=', $this->to)
                                            ->where('status', 1)
                                            ->count();
                    if($training_count){
                        session()->flash('found-conducted', 'Found '.$training_count.' Training!');
                    }else{
                        session()->flash('fail', 'Found '.$training_count.' Training!');
                    }
                    
                    break;
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
