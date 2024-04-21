<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\attendance;
use App\Models\RecommendedParticipant;
use App\Models\SelectedParticipant;
use App\Models\AttendedTraining;
use App\Models\otp;

use Carbon\Carbon;

class UpcomingTraining extends Component
{
    public $training_id;

    public $today;

    public $training_title;
    public $start_of_conduct;
    public $end_of_conduct;
    public $conducted_by = '';
    public $type_of_ld = '';
    public $source_of_budget = '';
    public $service_provider = '';
    public $responsible_unit = '';
    public $number_of_participants = 1;
    public $venue = '';
    public $training_type = '';
    public $reference;

    public $specific_training_type;
    public $specific_service_provider;
    public $specific_conducted_by;
    public $specific_type_of_ld;
    public $specific_source_of_budget;

    public $other_training_type = false;
    public $other_service_provider = false;
    public $other_conducted_by = false;
    public $other_type_of_ld = false;
    public $other_source_of_budget = false;


    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render()
    {
        $upcoming_trainings = OfficialTraining::where('status', 0)
                                                ->where('start_of_conduct', '>', $this->today)
                                ->orderBy('start_of_conduct', 'asc')->get();

        if($this->training_type == 'Others'){
            $this->other_training_type = true;
        }else{
            $this->other_training_type = false;
        }

        if($this->service_provider == 'Others'){
            $this->other_service_provider = true;
        }else{
            $this->other_service_provider = false;
        }

        if($this->conducted_by == 'Others'){
            $this->other_conducted_by = true;
        }else{
            $this->other_conducted_by = false;
        }

        if($this->type_of_ld == 'Others'){
            $this->other_type_of_ld = true;
        }else{
            $this->other_type_of_ld = false;
        }

        if($this->source_of_budget == 'Others'){
            $this->other_source_of_budget = true;
        }else{
            $this->other_source_of_budget = false;
        }
        return view('livewire.admin.upcoming-training', ['upcoming_trainings' => $upcoming_trainings]);
    }

    public function deleteID($training_id){
        $this->training_id = $training_id;
    }

    public function deleteOngoinTraining(){
        OfficialTraining::where('training_id', $this->training_id)->delete();
        attendance::where('training_id', $this->training_id)->delete();
        RecommendedParticipant::where('training_id', $this->training_id)->delete();
        SelectedParticipant::where('training_id', $this->training_id)->delete();
        AttendedTraining::where('training_id', $this->training_id)->delete();
        otp::where('training_id', $this->training_id)->delete();
    }

    public function resetFields(){
        $this->training_title;
        $this->start_of_conduct;
        $this->end_of_conduct;
        $this->conducted_by = '';
        $this->type_of_ld = '';
        $this->source_of_budget = '';
        $this->service_provider = '';
        $this->budget = '';
        $this->responsible_unit = '';
        $this->number_of_participants = 1;
        $this->venue = '';
        $this->training_type = '';
        $this->reference = '';
    }

    public function CreateTraining(){
        $this->validate([
            "training_title" => 'required|unique:official_trainings,training_title',
            "start_of_conduct" => 'required',
            "end_of_conduct" => 'required',
            "conducted_by" => 'required',
            "type_of_ld" => 'required',
            "source_of_budget" => 'required',
            "service_provider" => 'required',
            "responsible_unit" => 'required',
            "number_of_participants" => 'required',
            "venue" => 'required',
            "training_type" => 'required',
            "reference" => 'required',
        ]);

        try{
            $autoID = str_pad(mt_rand(1, 999999),6,0,STR_PAD_LEFT);
            $findExistingID = OfficialTraining::where('training_id', $autoID)->count();

            while ($findExistingID > 0){
                $autoID = str_pad(mt_rand(1, 999999),6,0,STR_PAD_LEFT);
                $findExistingID = OfficialTraining::where('training_id', $autoID)->count();
            }

            $start_date = Carbon::parse($this->start_of_conduct);
            $end_date = Carbon::parse($this->end_of_conduct);
            $number_of_days = $start_date->diffInDays($end_date) + 1;

            $number_of_hours = ($number_of_days * 8);

            if ($this->training_type == 'Others'){
                $this->training_type = $this->specific_training_type;
            }
            if ($this->service_provider == 'Others'){
                $this->service_provider = $this->specific_service_provider;
            }
            if ($this->conducted_by == 'Others'){
                $this->conducted_by = $this->specific_conducted_by;
            }
            if ($this->type_of_ld == 'Others'){
                $this->type_of_ld = $this->specific_type_of_ld;
            }
            if ($this->source_of_budget == 'Others'){
                $this->source_of_budget = $this->specific_source_of_budget;
            }

            $values = [
                'training_id' => $autoID,
                'training_title' => $this->training_title,
                'start_of_conduct' => $this->start_of_conduct,
                'end_of_conduct' => $this->end_of_conduct,
                'number_of_hours' => $number_of_hours,
                'conducted_by' => $this->conducted_by,
                'type_of_ld' => $this->type_of_ld,
                'source_of_budget' => $this->source_of_budget,
                'service_provider' => $this->service_provider,
                'status' => 0,
                'responsible_unit' => $this->responsible_unit,
                'number_of_participants' => $this->number_of_participants,
                'venue' => $this->venue,
                'training_type' => $this->training_type,
                'reference' => $this->reference
            ];

            OfficialTraining::create($values);
            session()->flash('success', 'Training Created!');
            $this->dispatch('hide_modal');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
