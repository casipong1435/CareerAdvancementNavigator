<?php

namespace App\Livewire\User;
use App\Models\PendingTraining;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;

use Livewire\WithFileUploads;

use Livewire\Component;

class MyAddedTraining extends Component
{
    use WithFileUploads;
    
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy;

    public $training_title;
    public $start_of_conduct;
    public $end_of_conduct;
    public $conducted_by = '';
    public $type_of_ld = '';
    public $source_of_budget = '';
    public $service_provider = '';
    public $responsible_unit = '';
    public $number_of_participants = '';
    public $venue = '';
    public $reference = '';
    public $training_type = '';
    public $certificate_of_participation;

    public $other_conducted_by = '';
    public $other_type_of_ld = '';
    public $other_source_of_budget = '';
    public $other_service_provider = '';

    public $employee_id;

    public $training_id = '';

    public $training = '';
    public $today;

    public $from;
    public $to;

    public $select_training = true;

    public $specific_training_type;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
        $this->employee_id = auth()->user()->employee_id;
    }

    public function render()
    {
        $pending_trainings = PendingTraining::where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('training_id', $this->search_input)
                                ->search('number_of_hours', $this->search_input)
                                ->search('start_of_conduct', $this->search_input)
                                ->search('end_of_conduct', $this->search_input);
                            })
                            ->when($this->orderBy, function($query){
                                $query->orderBy($this->orderBy, $this->sortBy);
                            })
                            ->where('employee_id', $this->employee_id)
                            ->orderBy('status', 'asc')->get();

        $added_training = PendingTraining::where('status', 1)->where('employee_id', $this->employee_id)->count();

        $official_training = OfficialTraining::where('status', 1)->get(['id','training_id', 'training_title', 'start_of_conduct', 'end_of_conduct']);

            if ($this->training == 'others'){
                $this->resetFields();
                $this->select_training = false;
            }else{
                    
                if($this->training){
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
                    $this->number_of_participants = $old_training->number_of_participants;
                    $this->venue = $old_training->venue;
                    $this->training_type = $old_training->training_type;
                    $this->reference = $old_training->reference;
                }
            }
        
        
        return view('livewire.user.my-added-training', ['pending_trainings' => $pending_trainings, 'official_training' => $official_training, 'added_training' => $added_training]);
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

        $this->other_conducted_by = '';
        $this->other_type_of_ld = '';
        $this->other_source_of_budget = '';
        $this->other_service_provider = '';

        $this->responsible_unit = '';
        $this->number_of_participants = '';
        $this->venue = '';
        $this->training_type = '';
        $this->reference = '';
        $this->specific_training_type = '';

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
            "training_type" => 'required',
            "certificate_of_participation" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try{

            $start_date = Carbon::parse($this->start_of_conduct);
            $end_date = Carbon::parse($this->end_of_conduct);
            $number_of_days = $start_date->diffInDays($end_date) + 1;

            $number_of_hours = ($number_of_days * 8);

            $fileName = time().'.'.$this->certificate_of_participation->getClientOriginalExtension();
            $if_exist = PendingTraining::where('training_title', $this->training_title)
                                        ->where('start_of_conduct', $this->start_of_conduct)
                                        ->where('end_of_conduct', $this->end_of_conduct)->count();
            if($if_exist <= 0){

                if ($this->conducted_by == 'Others'){
                    $this->conducted_by = $this->other_conducted_by;
                }

                if ($this->type_of_ld == 'Others'){
                    $this->type_of_ld = $this->other_type_of_ld;
                }

                if ($this->source_of_budget == 'Others'){
                    $this->source_of_budget = $this->other_source_of_budget;
                }
                
                if ($this->service_provider == 'Others'){
                    $this->service_provider = $this->other_service_provider;
                }

                if ($this->training_type == 'Others'){
                    $this->training_type = $this->specific_training_type;
                }
                
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
                    'number_of_participants' => $this->number_of_participants,
                    'venue' => $this->venue,
                    'reference' => $this->reference,
                    'training_type' => $this->training_type,
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

    public function deleteUnverifiedTraining($id, $cop){
        try{
            //dd(public_path('storage/certificates/'.$cop));
            PendingTraining::where('id', $id)->delete();
            unlink(public_path('storage/certificates/'.$cop));
            session()->flash('success', 'Deleted Succefully!');
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }
    }

    public function generateReport(){

        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        try{
            $added_trainings = PendingTraining::where('employee_id', $this->employee_id)
            ->where('status', 1)
            ->where('start_of_conduct', '>=', $this->from)
            ->where('start_of_conduct', '<=', $this->to)
            ->count();

            if($added_trainings > 0){
                session()->flash('found-report', 'Found '.$added_trainings.' Training!');
            }else{
                session()->flash('fail', 'Found '.$added_trainings.' Training!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}