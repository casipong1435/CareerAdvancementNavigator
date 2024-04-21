<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\GadAssessmentQuestion;
use App\Models\GadAssessmentAnswer;

use Carbon\Carbon;

class GadSurveyQuestion extends Component
{
    public $selected_gad_activity = [];
    public $limitReach = false;
    public $today;
    public $employee_id;

    public $isSubmitted = false;

    public $state = 1;
    public $isUpdate = false;
    public $yearNow;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila');
        $this->employee_id = auth()->user()->employee_id;
        $this->yearNow = $this->today->format('Y');

        $answers = GadAssessmentAnswer::where('employee_id', $this->employee_id)->first(['question_id']);
        if($answers){
            $this->selected_gad_activity = json_decode($answers->question_id);
            $this->isSubmitted = true;
            $this->state = 0;
        }

    }

    public function render()
    {
        $gad_activity = GadAssessmentQuestion::where('year', $this->yearNow)->where('status', 1)->get();
        

        if(count($this->selected_gad_activity) >= 3){
            $this->limitReach = true;
        }else{
            $this->limitReach = false;
        }
        return view('livewire.user.gad-survey-question', ['gad_activity' => $gad_activity]);
    }

    public function selectActivity(){
        $this->validate([
            'selected_gad_activity' => 'required|array|size:3'
        ]);

        try{
            if ($this->isUpdate){

                $value_json = json_encode($this->selected_gad_activity);
            
                GadAssessmentAnswer::where('employee_id', $this->employee_id)->update([
                    'question_id' => $value_json,
                    'date_answered' => $this->today
                ]);
                session()->flash('success', 'Response Updated!');
            }else{
                $value_json = json_encode($this->selected_gad_activity);
            
                GadAssessmentAnswer::create([
                    'employee_id' => $this->employee_id,
                    'question_id' => $value_json,
                    'date_answered' => $this->today
                ]);
                session()->flash('success', 'Response Submitted!');
            }
            
            
            return redirect()->to('/user/dashboard/gad-need-assessment');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }

    }

    public function resetData(){
        $answers = GadAssessmentAnswer::where('employee_id', $this->employee_id)->first(['question_id']);
        if($answers){
            $this->selected_gad_activity = json_decode($answers->question_id);
            $this->isSubmitted = true;
        }
    }

    public function changeState($state){
        $this->state = $state;

        if ($state == 0){
            $this->resetData();
            $this->isUpdate = false;
        }else{
            $this->selected_gad_activity = [];
            $this->isUpdate = true;
        }
    }
}
