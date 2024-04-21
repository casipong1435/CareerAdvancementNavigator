<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\OfficialTraining;
use App\Models\RecommendedParticipant;
use App\Models\Criteria;
use App\Models\PositionCategory;
use Auth;
use DB;

class ViewUpcomingTrainingInfo extends Component
{

    public $training_id;

    // User Table Variables
    public $subordinate_sex = null;
    public $subordinate_search_input = "";

    // Recommended Table Variables
    public $recommend_orderBy = "first_name";
    public $recommend_sortBy = "asc";
    public $recommend_sex = null;
    public $recommend_search_input = "";

    public $date_created;
    public $agefrom = 17;
    public $ageto = 65;

    public $criteria_subject_area = [];
    public $criteria_age;
    public $criteria_sex;
    public $criteria_category = [];
    public $criteria_level;
    public $criteria_position = [];

    public $teaching_positions;
    public $non_teaching_positions;
    public $teaching_related_positions;

    public function mount($training_id){
        $this->training_id = $training_id;
    }
    
    public function render()
    {   
        $criterias = Criteria::where('training_id', $this->training_id)->first();

        if ($criterias){

            if ($criterias->subject_area != null){
                $this->criteria_subject_area = json_decode($criterias->subject_area);
            }
            if ($criterias->category != null){
                $this->criteria_category = json_decode($criterias->category);
            }
            if ($criterias->position != null){
                $this->criteria_position = json_decode($criterias->position);
            }
            if ($criterias->age != null){
                $this->criteria_age = $criterias->age;
                $this->age = explode('-', $criterias->age);
                $this->agefrom = $this->age[0];
                $this->ageto = $this->age[1];
            }
            
        }

        $training_info = OfficialTraining::where('training_id', $this->training_id)->first();

        $user = Auth::user()->employee_id;
        $userdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->where('users.employee_id', $user)->first(['description', 'district', 'school', 'position']);

        switch ($userdata->position){
            case 'EPS':
                
                $recommended_participants = RecommendedParticipant::leftJoin('users', 'recommended_participants.employee_id', '=', 'users.employee_id')
                        ->leftJoin('profiles', 'recommended_participants.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->recommend_search_input)
                            ->search('profiles.first_name', $this->recommend_search_input)
                            ->search('profiles.last_name', $this->recommend_search_input)
                            ->search('profiles.sex', $this->recommend_search_input)
                            ->search('users.position', $this->recommend_search_input)
                            ->search('profiles.age', $this->recommend_search_input);
                        })
                        ->when($this->recommend_sex, function($query){
                            $query->where('profiles.sex', $this->recommend_sex);
                        })
                        ->where('training_id',$this->training_id)
                        ->where('recommended_by', $userdata->position)
                        ->orderBy($this->recommend_orderBy, $this->recommend_sortBy)
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position']);

                $employee_ids = $recommended_participants->pluck('employee_id');

                $profiles = User::select([
                        'users.employee_id', 
                        'first_name', 
                        'last_name', 
                        'age', 
                        'sex', 
                        'position', 
                        'subject_areas.description',
                        \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                    ])
                        ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                        ->leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                            ->where(function($query){
                                $query->search('users.employee_id', $this->subordinate_search_input)
                                    ->search('profiles.first_name', $this->subordinate_search_input)
                                    ->search('profiles.age', $this->subordinate_search_input)
                                    ->search('subject_areas.description', $this->subordinate_search_input)
                                    ->search('users.position', $this->subordinate_search_input)
                                    ->search('profiles.sex', $this->subordinate_search_input);
                            })
                            ->when($this->criteria_position, function($query){
                                $query->whereIn('position', $this->criteria_position);
                            })
                            ->when($this->criteria_sex, function($query){
                                $query->where('sex', $this->criteria_sex);
                            })
                            ->when($this->criteria_level, function($query){
                                $query->where('level', $this->criteria_level);
                            })
                            ->where('age', '>=', $this->agefrom)
                            ->where('age', '<=', $this->ageto)
                            ->where('users.category', 'Teaching')
                            ->where('job_status', 1)
                            ->where('users.status', 1)
                            ->whereIn('subject_areas.description', [$userdata->description])
                            ->whereNotIn('users.employee_id', $employee_ids)
                            ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                            ->orderBy('number_of_attended_training', 'asc')
                            ->get();
                
                break;

            case 'PSDS':

                $recommended_participants = RecommendedParticipant::leftJoin('users', 'recommended_participants.employee_id', '=', 'users.employee_id')
                        ->leftJoin('profiles', 'recommended_participants.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->recommend_search_input)
                            ->search('profiles.first_name', $this->recommend_search_input)
                            ->search('profiles.last_name', $this->recommend_search_input)
                            ->search('profiles.sex', $this->recommend_search_input)
                            ->search('users.position', $this->recommend_search_input)
                            ->search('profiles.age', $this->recommend_search_input);
                        })
                        ->when($this->recommend_sex, function($query){
                            $query->where('profiles.sex', $this->recommend_sex);
                        })
                        ->where('training_id',$this->training_id)
                        ->where('recommended_by', $userdata->position)
                        ->orderBy($this->recommend_orderBy, $this->recommend_sortBy)
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position']);

                $employee_ids = $recommended_participants->pluck('employee_id');
                

                $profiles = User::select([
                            'users.employee_id', 
                            'first_name', 
                            'last_name', 
                            'age', 
                            'sex', 
                            'position', 
                            'subject_areas.description',
                            \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                        ])
                            ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                            ->leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                            ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                            ->where(function($query){
                            $query->search('users.employee_id', $this->subordinate_search_input)
                                ->search('profiles.first_name', $this->subordinate_search_input)
                                ->search('profiles.age', $this->subordinate_search_input)
                                ->search('subject_areas.description', $this->subordinate_search_input)
                                ->search('users.position', $this->subordinate_search_input)
                                ->search('profiles.sex', $this->subordinate_search_input);
                            })
                            ->when($this->criteria_subject_area, function($query){
                                $query->whereIn('subject_areas.description', $this->criteria_subject_area);
                            })
                            ->when($this->criteria_position, function($query){
                                $query->whereIn('position', $this->criteria_position);
                            })
                            ->when($this->criteria_sex, function($query){
                                $query->where('sex', $this->criteria_sex);
                            })
                            ->when($this->subordinate_sex, function($query){
                                $query->where('sex', $this->subordinate_sex);
                            })
                            ->when($this->criteria_level, function($query){
                                $query->where('level', $this->criteria_level);
                            })
                            ->where('age', '>=', $this->agefrom)
                            ->where('age', '<=', $this->ageto)
                            ->where('users.category', 'Teaching')
                            ->where('job_status', 1)
                            ->where('users.status', 1)
                            ->where('profiles.district', $userdata->district)
                            ->whereNotIn('users.employee_id', $employee_ids)
                            ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                            ->orderBy('number_of_attended_training', 'asc')
                            ->get();

                
                break;

            case 'SDS':
                
                $recommended_participants = RecommendedParticipant::leftJoin('users', 'recommended_participants.employee_id', '=', 'users.employee_id')
                        ->leftJoin('profiles', 'recommended_participants.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->recommend_search_input)
                            ->search('profiles.first_name', $this->recommend_search_input)
                            ->search('profiles.last_name', $this->recommend_search_input)
                            ->search('profiles.sex', $this->recommend_search_input)
                            ->search('users.position', $this->recommend_search_input)
                            ->search('profiles.age', $this->recommend_search_input);
                        })
                        ->when($this->recommend_sex, function($query){
                            $query->where('profiles.sex', $this->recommend_sex);
                        })
                        ->where('training_id',$this->training_id)
                        ->where('recommended_by', $userdata->position)
                        ->orderBy($this->recommend_orderBy, $this->recommend_sortBy)
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position']);

                $employee_ids = $recommended_participants->pluck('employee_id');


                $profiles = User::select([
                            'users.employee_id', 
                            'first_name', 
                            'last_name', 
                            'age', 
                            'sex', 
                            'position', 
                            'subject_areas.description',
                            \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                        ])
                            ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                            ->leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                            ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                            ->where(function($query){
                            $query->search('users.employee_id', $this->subordinate_search_input)
                                ->search('profiles.first_name', $this->subordinate_search_input)
                                ->search('profiles.age', $this->subordinate_search_input)
                                ->search('subject_areas.description', $this->subordinate_search_input)
                                ->search('users.position', $this->subordinate_search_input)
                                ->search('profiles.sex', $this->subordinate_search_input);
                            })
                            ->when($this->criteria_subject_area, function($query){
                                $query->whereIn('subject_areas.description', $this->criteria_subject_area);
                            })
                            ->when($this->criteria_position, function($query){
                                $query->whereIn('position', $this->criteria_position);
                            })
                            ->when($this->criteria_sex, function($query){
                                $query->where('sex', $this->criteria_sex);
                            })
                            ->when($this->criteria_level, function($query){
                                $query->where('level', $this->criteria_level);
                            })
                            ->where('age', '>=', $this->agefrom)
                            ->where('age', '<=', $this->ageto)
                            ->where('users.category', 'Teaching')
                            ->where('job_status', 1)
                            ->where('users.status', 1)
                            ->whereNotIn('users.employee_id', $employee_ids)
                            ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                            ->orderBy('number_of_attended_training', 'asc')
                            ->get();
            
                break;

            case 'OSDS':
                
                $recommended_participants = RecommendedParticipant::leftJoin('users', 'recommended_participants.employee_id', '=', 'users.employee_id')
                        ->leftJoin('profiles', 'recommended_participants.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->recommend_search_input)
                            ->search('profiles.first_name', $this->recommend_search_input)
                            ->search('profiles.last_name', $this->recommend_search_input)
                            ->search('profiles.sex', $this->recommend_search_input)
                            ->search('users.position', $this->recommend_search_input)
                            ->search('profiles.age', $this->recommend_search_input);
                        })
                        ->when($this->recommend_sex, function($query){
                            $query->where('profiles.sex', $this->recommend_sex);
                        })
                        ->where('training_id',$this->training_id)
                        ->where('recommended_by', $userdata->position)
                        ->orderBy($this->recommend_orderBy, $this->recommend_sortBy)
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position']);

                $employee_ids = $recommended_participants->pluck('employee_id');

                $profiles = User::select([
                        'users.employee_id', 
                        'first_name', 
                        'last_name', 
                        'age', 
                        'sex', 
                        'position', 
                        'subject_areas.description',
                        \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                    ])
                        ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                        ->leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                        ->where(function($query){
                        $query->search('users.employee_id', $this->subordinate_search_input)
                            ->search('profiles.first_name', $this->subordinate_search_input)
                            ->search('profiles.age', $this->subordinate_search_input)
                            ->search('subject_areas.description', $this->subordinate_search_input)
                            ->search('users.position', $this->subordinate_search_input)
                            ->search('profiles.sex', $this->subordinate_search_input);
                        })
                        ->when($this->criteria_subject_area, function($query){
                            $query->whereIn('subject_areas.description', $this->criteria_subject_area);
                        })
                        ->when($this->criteria_position, function($query){
                            $query->whereIn('position', $this->criteria_position);
                        })
                        ->when($this->criteria_sex, function($query){
                            $query->where('sex', $this->criteria_sex);
                        })
                        ->when($this->criteria_level, function($query){
                            $query->where('level', $this->criteria_level);
                        })
                        ->where('age', '>=', $this->agefrom)
                        ->where('age', '<=', $this->ageto)
                        ->where('users.category', 'Non-Teaching')
                        ->where('job_status', 1)
                        ->where('users.status', 1)
                        ->whereNotIn('users.employee_id', $employee_ids)
                        ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                        ->orderBy('number_of_attended_training', 'asc')
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position', 'subject_areas.description']);
                
                break;

            case 'School Head':

                $recommended_participants = RecommendedParticipant::leftJoin('users', 'recommended_participants.employee_id', '=', 'users.employee_id')
                        ->leftJoin('profiles', 'recommended_participants.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->subordinate_search_input)
                            ->search('profiles.first_name', $this->subordinate_search_input)
                            ->search('profiles.last_name', $this->subordinate_search_input)
                            ->search('profiles.sex', $this->subordinate_search_input)
                            ->search('users.position', $this->subordinate_search_input)
                            ->search('profiles.age', $this->subordinate_search_input);
                        })
                        ->when($this->recommend_sex, function($query){
                            $query->where('profiles.sex', $this->subordinate_sex);
                        })
                        ->where('training_id',$this->training_id)
                        ->where('recommended_by', $userdata->position)
                        ->orderBy($this->recommend_orderBy, $this->recommend_sortBy)
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position']);

                $employee_ids = $recommended_participants->pluck('employee_id');

                $profiles = User::select([
                        'users.employee_id', 
                        'first_name', 
                        'last_name', 
                        'age', 
                        'sex', 
                        'position', 
                        'subject_areas.description',
                        \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                    ])
                        ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                        ->leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                        ->where(function($query){
                        $query->search('users.employee_id', $this->subordinate_search_input)
                            ->search('profiles.first_name', $this->subordinate_search_input)
                            ->search('profiles.age', $this->subordinate_search_input)
                            ->search('subject_areas.description', $this->subordinate_search_input)
                            ->search('users.position', $this->subordinate_search_input)
                            ->search('profiles.sex', $this->subordinate_search_input);
                        })
                        ->when($this->criteria_subject_area, function($query){
                            $query->whereIn('subject_areas.description', $this->criteria_subject_area);
                        })
                        ->when($this->criteria_position, function($query){
                            $query->whereIn('position', $this->criteria_position);
                        })
                        ->when($this->criteria_sex, function($query){
                            $query->where('sex', $this->criteria_sex);
                        })
                        ->when($this->criteria_level, function($query){
                            $query->where('level', $this->criteria_level);
                        })
                        ->where('age', '>=', $this->agefrom)
                        ->where('age', '<=', $this->ageto)
                        ->where('job_status', 1)
                        ->where('users.status', 1)
                        ->whereIn('users.category', ['Teaching', 'Non-Teaching'])
                        ->where('profiles.school', $userdata->school)
                        ->whereNotIn('users.employee_id', $employee_ids)
                        ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                        ->orderBy('number_of_attended_training', 'asc')
                        ->get(['users.employee_id', 'first_name', 'last_name', 'age', 'sex', 'position', 'subject_areas.description']);
                break;
        }

        $this->teaching_positions = PositionCategory::where('category', 'Teaching')->get();
        $this->non_teaching_positions = PositionCategory::where('category', 'Non-Teaching')->get();
        $this->teaching_related_positions = PositionCategory::where('category', 'Teaching Related')->get();                     

        return view('livewire.user.view-upcoming-training-info', ['training_info' => $training_info, 'profiles' => $profiles, 'recommended_participants' => $recommended_participants, 'criterias' => $criterias]);
    }

    public function recommendUser($employee_id, $training_id){

        $position = auth()->user()->position;
        
        $values = [
            'employee_id' => $employee_id, 
            'training_id' => $training_id,
            'recommended_by' => $position
        ];

        RecommendedParticipant::create($values);
    }

    public function unRecommendUser($employee_id, $training_id){

        $position = auth()->user()->position;

        $employee_id = $employee_id;
        $training_id = $training_id;
        $query = RecommendedParticipant::where('employee_id', $employee_id)
                                        ->where('training_id', $training_id)
                                        ->where('recommended_by', $position)->delete();
        
    }

    public function setCriteria(){

        $new_subject_area = json_encode($this->criteria_subject_area);
        $new_category = json_encode($this->criteria_category);
        $new_position = json_encode($this->criteria_position);

        if($new_subject_area == "[]"){
            $new_subject_area = null;
        }
        if($new_category == "[]"){
            $new_category = null;
        }
        if($new_position == "[]"){
            $new_position = null;
        }

        $values1 = [
            'age' => $this->criteria_age,
            'subject_area' => $new_subject_area,
            'sex' => $this->criteria_sex,
            'category' => $new_category,
            'position' => $new_position,
            'level' => $this->criteria_level
        ];

        $values2 = [
            'training_id' => $this->training_id,
            'age' => $this->criteria_age,
            'subject_area' => $new_subject_area,
            'sex' => $this->criteria_sex,
            'category' => $new_category,
            'position' => $new_position,
            'level' => $this->criteria_level
        ];

        $check_if_training_exist =  Criteria::where('training_id', $this->training_id)->count();

        if ($check_if_training_exist > 0){
            Criteria::where('training_id', $this->training_id)->update($values1);
            session()->flash('success', true);
        }else{
            Criteria::create($values2);
            session()->flash('success', true);
        }

    }
}
