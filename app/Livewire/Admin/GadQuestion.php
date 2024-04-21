<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GadAssessmentQuestion;
use Carbon\Carbon;

class GadQuestion extends Component
{

    public $id;
    public $description;
    public $new_question;
    public $calendar_year = null;
    public $today;
    public $start_year = 2024;
    public $end_year;
    public $isAssessment = false;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->format('Y');
        $this->calendar_year = $this->today;
        $this->end_year = $this->today + 1;
    }

    public function render()
    {
        $questions = GadAssessmentQuestion::where('year', $this->calendar_year)->get();
        if (count($questions) > 0){
            $nowAssessing = $questions[0]->status;
            $this->isAssessment = $nowAssessing == 0 ? false:true;
        }else{
            $this->isAssessment = false;
        }
        
        return view('livewire.admin.gad-question', ['questions' => $questions]);
    }

    public function QuestionID($id){
        $question = GadAssessmentQuestion::where('id', $id)->first(['description']);
        $this->id = $id;
        $this->description = $question->description;
    }


    public function EditQuestion(){
        try{
            GadAssessmentQuestion::where('id', $this->id)->update(['description' => $this->description]);
            $this->dispatch('hide_modal');
            session()->flash('success', "Activity Updated!");
        }catch(\Exception $e){
            session()->flash('error', "Something went wrong!!");
        }
    }
    
    public function deleteQuestion($id){
        try{
            $question = GadAssessmentQuestion::where('id', $id)->delete();
            session()->flash('success', "Activity Deleted!");
        }catch(\Exception $e){
            session()->flash('error', "Something went wrong!!");
        }
    }

    public function AddQuestion(){
        $this->validate([
            'new_question' => 'required'
        ]);
        
        try{
            GadAssessmentQuestion::create(['description' => $this->new_question, 'year' => $this->calendar_year]);
            $this->dispatch('hide_modal');
            session()->flash('success', "New Activity Added!");
        }catch(\Exception $e){
            session()->flash('error', "Something went wrong!!");
        }
    }

    public function startAssessment(){
       try{
            GadAssessmentQuestion::where('year', $this->calendar_year)->update(['status' => 1]);
            session()->flash('success', 'Assessment Started!');
            $this->isAssessment = true;
       }catch(\Exception $e){
            session()->flash('error', "Something went wrong!!");
       }
    }

    public function cancelAssessment(){
        try{
             GadAssessmentQuestion::where('year', $this->calendar_year)->update(['status' => 0]);
             session()->flash('success', 'Assessment Cancelled!');
             $this->isAssessment = false;
        }catch(\Exception $e){
             session()->flash('error', "Something went wrong!!");
        }
     }
}
