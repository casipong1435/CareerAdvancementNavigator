<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use App\Models\AttendedTraining;
use App\Models\OfficialTraining;
use App\Models\PendingTraining;
use Carbon\Carbon;
use Auth;

use Livewire\WithFileUploads;

class UserTrainingList extends Component
{
    use WithFileUploads;

    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";
    public $today;

    public $training_title;
    public $start_of_conduct;
    public $end_of_conduct;
    public $conducted_by = '';
    public $type_of_ld = '';
    public $source_of_budget = '';
    public $service_provider = '';
    public $responsible_unit = '';
    public $certificate_of_participation;

    public $employee_id;

    public $training_id = '';

    public $training = '';

    public $select_training = false;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
        $this->employee_id = auth()->user()->employee_id;
    }

    public function resetFields(){
        $this->training_id = '';
        $this->training_title = '';
        $this->start_of_conduct = '';
        $this->end_of_conduct = '';
        $this->conducted_by = '';
        $this->type_of_ld = '';
        $this->source_of_budget = '';
        $this->service_provider = '';
        $this->responsible_unit = '';
    }

    public function render()
    {
        $employee_id = Auth::user()->employee_id;

        $attended_trainings = AttendedTraining::join('official_trainings','attended_trainings.training_id', '=','official_trainings.training_id')
                        ->where(function($query){
                            $query->search('training_title', $this->search_input)
                            ->search('official_trainings.training_id', $this->search_input)
                            ->search('number_of_hours', $this->search_input)
                            ->search('start_of_conduct', $this->search_input)
                            ->search('end_of_conduct', $this->search_input);
                        })
                        ->where('attended_trainings.employee_id', $employee_id)
                        ->orderBy($this->orderBy, $this->sortBy)->get();
        
        $official_training = OfficialTraining::where('status', 1)->get(['id','training_id', 'training_title', 'start_of_conduct', 'end_of_conduct']);

        if ($this->training == 'others' || $this->training == ''){
            $this->resetFields();
            $this->select_training = false;
        }else{

            $old_training = OfficialTraining::where('id', $this->training)->first();
            $this->select_training = true;
            $this->training_id = $old_training->training_id;
            $this->training_title = $old_training->training_title;
            $this->start_of_conduct = $old_training->start_of_conduct;
            $this->end_of_conduct = $old_training->end_of_conduct;
            $this->conducted_by = $old_training->conducted_by;
            $this->type_of_ld = $old_training->type_of_ld;
            $this->source_of_budget = $old_training->source_of_budget;
            $this->service_provider = $old_training->service_provider;
            $this->responsible_unit = $old_training->responsible_unit;
        }
        return view('livewire.user.user-training-list', ['attended_trainings' => $attended_trainings, 'official_training' => $official_training]);
    }

    public function AddTraining(){
        $this->validate([
            "training_title" => 'required',
            "start_of_conduct" => 'required',
            "end_of_conduct" => 'required',
            "conducted_by" => 'required',
            "type_of_ld" => 'required',
            "source_of_budget" => 'required',
            "service_provider" => 'required',
            "certificate_of_participation" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try{

            $start_date = Carbon::parse($this->start_of_conduct);
            $end_date = Carbon::parse($this->end_of_conduct);
            $number_of_days = $start_date->diffInDays($end_date) + 1;

            $number_of_hours = ($number_of_days * 8);

            $fileName = time().'.'.$this->certificate_of_participation->getClientOriginalExtension();

            $if_exist = PendingTraining::where('training_id', $this->training_id)
                                        ->orWhere('training_title', $this->training_title)
                                        ->where('start_of_conduct', $this->start_of_conduct)
                                        ->where('end_of_conduct', $this->end_of_conduct)->count();
            if($if_exist <= 0){
                $values = [
                    'employee_id' => $this->employee_id,
                    'training_id' => $this->training_id,
                    'training_title' => $this->training_title,
                    'start_of_conduct' => $this->start_of_conduct,
                    'end_of_conduct' => $this->end_of_conduct,
                    'number_of_hours' => $number_of_hours,
                    'conducted_by' => $this->conducted_by,
                    'type_of_ld' => $this->type_of_ld,
                    'source_of_budget' => $this->source_of_budget,
                    'service_provider' => $this->service_provider,
                    'responsible_unit' => $this->responsible_unit,
                    'cop' => $fileName,
                    'status' => 0
                ];
                PendingTraining::create($values);
                $this->certificate_of_participation->storeAs('certificates', $fileName, 'public');
                session()->flash('success', 'Training Created!');
                $this->dispatch('hide_modal');
            }else{
                session()->flash('exist', 'Already Added!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
