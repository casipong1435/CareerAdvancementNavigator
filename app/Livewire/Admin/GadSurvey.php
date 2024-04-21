<?php

namespace App\Livewire\Admin;
use App\Models\GadAssessmentAnswer;
use App\Models\GadAssessmentQuestion;
use App\Models\User;
use Carbon\Carbon;

use Livewire\Component;

class GadSurvey extends Component
{

    public $teachingList = false;
    public $non_teachingList = false;
    public $teaching_relatedList = false;

    public $calendar_year = null;
    public $today;
    public $start_year = 2024;
    public $end_year;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->format('Y');
        $this->calendar_year = $this->today;
        $this->end_year = $this->today + 1;
    }

    public function render()
    {
        $answers = GadAssessmentAnswer::whereYear('date_answered', $this->calendar_year)->get(['question_id']);
                        
        $mergedArray = $answers->map(function ($item) {
            return array_merge(json_decode($item->question_id, true)); 
        });
        $newArray = $mergedArray->toArray();

        $tempArray = [];

        foreach ($newArray as $innerArray) {
            $tempArray = array_merge($tempArray, $innerArray);
        }

        $occurrences = array_count_values($tempArray);

        $question_description = GadAssessmentQuestion::whereIn('id', $tempArray)->get(['description', 'id']);

        // Sort $question_description based on number of occurrences in descending order
        $question_description = $question_description->sortByDesc(function ($question) use ($occurrences) {
            return $occurrences[$question->id];
        });

        $teaching_respondents = GadAssessmentAnswer::leftJoin('users', 'gad_assessment_answers.employee_id', '=', 'users.employee_id')
                                                ->leftJoin('profiles', 'gad_assessment_answers.employee_id', '=', 'profiles.employee_id')
                                                ->whereYear('date_answered', $this->calendar_year)
                                                ->where('users.category', 'Teaching')->get(['first_name', 'last_name', 'position']);

        $non_teaching_respondents = GadAssessmentAnswer::leftJoin('users', 'gad_assessment_answers.employee_id', '=', 'users.employee_id')
                                                ->leftJoin('profiles', 'gad_assessment_answers.employee_id', '=', 'profiles.employee_id')
                                                ->whereYear('date_answered', $this->calendar_year)
                                                ->where('users.category', 'Non-Teaching')->get(['first_name', 'last_name', 'position']);

        $teaching_related_respondents = GadAssessmentAnswer::leftJoin('users', 'gad_assessment_answers.employee_id', '=', 'users.employee_id')
                                                ->leftJoin('profiles', 'gad_assessment_answers.employee_id', '=', 'profiles.employee_id')
                                                ->whereYear('date_answered', $this->calendar_year)
                                                ->where('users.category', 'Teaching Related')->get(['first_name', 'last_name', 'position']);

        $teaching_count = User::where('category', 'Teaching')->where('status', 1)->where('job_status', 1)->count();
        $non_teaching_count = User::where('category', 'Non-Teaching')->where('status', 1)->where('job_status', 1)->count();
        $teaching_related_count = User::where('category', 'Teaching Related')->whereNot('position', 'HR')->where('status', 1)->where('job_status', 1)->count();

        return view('livewire.admin.gad-survey', ['question_description' => $question_description, 'occurrences' => $occurrences, 'teaching_respondents' => $teaching_respondents, 'non_teaching_respondents' => $non_teaching_respondents, 'teaching_related_respondents' => $teaching_related_respondents, 'teaching_count' => $teaching_count, 'non_teaching_count' => $non_teaching_count, 'teaching_related_count' => $teaching_related_count]);
    }

    public function clickList($state){
        
        switch($state){
            case "teaching":
                $this->teachingList ? $this->teachingList = false:$this->teachingList = true;
                break;
            case "non_teaching":
                $this->non_teachingList ? $this->non_teachingList = false:$this->non_teachingList = true;
                break;
            case "teaching_related":
                $this->teaching_relatedList ? $this->teaching_relatedList = false:$this->teaching_relatedList = true;
                break;
        }

    }
}
