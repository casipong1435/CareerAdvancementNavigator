<?php

namespace App\Livewire;
use App\Models\OfficialTraining;
use App\Models\otp;
use App\Models\SelectedParticipant;
use App\Models\AttendedTraining;
use App\Models\RecommendedParticipant;
use App\Models\PositionCategory;
use App\Models\User;
use App\Models\Criteria;
use DB;
use Livewire\Component;

class CreatedTrainingInfo extends Component
{
    public $training_id;

    public $userlist_search_input = "";

    public $recommendeduser_search_input = "";
    public $recommendedby;
    public $recommendeduser_sortBy = "asc";
    public $recommendeduser_position;
    public $recommendeduser_sex;
    public $recommendeduser_orderBy = 'first_name';

    public $selecteduser_search_input = "";
    public $selecteduser_sortBy = "asc";
    public $selecteduser_position;
    public $selecteduser_sex;
    public $selecteduser_orderBy = 'first_name';

    public $attended_search_input = "";
    public $attended_sortBy = "asc";
    public $attended_position;
    public $attended_sex;
    public $attended_orderBy = 'first_name';

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
    public $training;

    public function mount($training_id){
        $this->training_id = $training_id;
        $this->training = OfficialTraining::where('training_id', $this->training_id)->first();
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
        $training_info = $this->training;
        $created_otp = otp::distinct()->where('training_id', $this->training_id)->get(['date_created']);

        $other_training_selected = SelectedParticipant::leftJoin('official_trainings', 'selected_participants.training_id', '=', 'official_trainings.training_id')
                                                    ->leftJoin('profiles', 'selected_participants.employee_id', '=', 'profiles.employee_id')
                                                    ->leftJoin('users', 'selected_participants.employee_id', '=', 'users.employee_id')
                                                    ->where('end_of_conduct','>=', $training_info->start_of_conduct)
                                                    ->where('start_of_conduct','<=', $training_info->end_of_conduct)
                                                    ->where('official_trainings.status', 0)
                                                    ->get();

        $other_selected_employee = $other_training_selected->pluck('employee_id');

        $selected_participant = SelectedParticipant::leftJoin('users', 'selected_participants.employee_id', 'users.employee_id')
                            ->leftJoin('profiles', 'selected_participants.employee_id', 'profiles.employee_id')
                            ->where(function($query){
                                $query->search('users.employee_id', $this->selecteduser_search_input)
                                    ->search('profiles.first_name', $this->selecteduser_search_input)
                                    ->search('profiles.age', $this->selecteduser_search_input)
                                    ->search('users.position', $this->selecteduser_search_input)
                                    ->search('profiles.sex', $this->selecteduser_search_input);
                            })
                            ->when($this->selecteduser_position, function($query){
                                $query->where('users.position', $this->selecteduser_position);
                            })
                            ->when($this->selecteduser_sex, function($query){
                                $query->where('profiles.sex', $this->selecteduser_sex);
                            })
                            ->orderBy($this->selecteduser_orderBy, $this->selecteduser_sortBy)
                            ->where('selected_participants.training_id', $this->training_id)
                            ->get();

        $employee_ids = $selected_participant->pluck('employee_id');

        $recommended_participant = RecommendedParticipant::select([
                                'users.employee_id', 
                                'first_name', 'last_name', 
                                'age', 'position', 
                                'subject_areas.description', 
                                'sex', 
                                'category',
                                'recommended_by',
                                \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                            ])
                            ->leftJoin('users', 'recommended_participants.employee_id', 'users.employee_id')
                            ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                            ->leftJoin('profiles', 'recommended_participants.employee_id', 'profiles.employee_id')
                            ->leftJoin('subject_areas', 'recommended_participants.employee_id', 'subject_areas.employee_id')
                            ->where(function($query){
                                $query->search('users.employee_id', $this->recommendeduser_search_input)
                                    ->search('profiles.first_name', $this->recommendeduser_search_input)
                                    ->search('profiles.age', $this->recommendeduser_search_input)
                                    ->search('subject_areas.description', $this->recommendeduser_search_input)
                                    ->search('users.position', $this->recommendeduser_search_input)
                                    ->search('profiles.sex', $this->recommendeduser_search_input)
                                    ->search('recommended_participants.recommended_by', $this->recommendeduser_search_input);
                            })
                            ->when($this->recommendeduser_position, function($query){
                                $query->where('users.position', $this->recommendeduser_position);
                            })
                            ->when($this->recommendedby, function($query){
                                $query->where('recommended_by', $this->recommendedby);
                            })
                            ->when($this->recommendeduser_sex, function($query){
                                $query->where('profiles.sex', $this->recommendeduser_sex);
                            })
                            ->where('users.role', 0)
                            ->where('recommended_participants.training_id', $this->training_id)
                            ->whereNotIn('recommended_participants.employee_id', $employee_ids)
                            ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category', 'recommended_by')
                            ->orderBy('number_of_attended_training', 'asc')
                            ->distinct()
                            ->get();

        $profiles = User::select([
                                'users.employee_id', 
                                'first_name', 'last_name', 
                                'age', 'position', 
                                'subject_areas.description', 
                                'sex', 
                                'category',
                                \DB::raw('COUNT(attended_trainings.employee_id) as number_of_attended_training')
                            ])
                            ->leftJoin('attended_trainings', 'users.employee_id', 'attended_trainings.employee_id')
                            ->leftJoin('profiles', 'users.employee_id', 'profiles.employee_id')
                            ->leftJoin('subject_areas', 'users.employee_id', 'subject_areas.employee_id')
                            ->leftJoin('educational_attainments', 'users.employee_id', 'educational_attainments.employee_id')
                            ->where(function($query){
                                $query->search('users.employee_id', $this->userlist_search_input)
                                    ->search('profiles.first_name', $this->userlist_search_input)
                                    ->search('profiles.age', $this->userlist_search_input)
                                    ->search('subject_areas.description', $this->userlist_search_input)
                                    ->search('users.position', $this->userlist_search_input)
                                    ->search('profiles.sex', $this->userlist_search_input);
                            })
                            ->when($this->criteria_subject_area, function($query){
                                $query->whereIn('subject_areas.description', $this->criteria_subject_area);
                            })
                            ->when($this->criteria_category, function($query){
                                $query->whereIn('category', $this->criteria_category);
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
                            ->whereNot('position', 'HR')
                            ->where('users.status', 1)
                            ->where('job_status', 1)
                            ->whereNotIn('users.employee_id', $employee_ids)
                            ->whereNotIn('users.employee_id', $other_selected_employee)
                            ->groupBy('users.employee_id', 'first_name', 'last_name', 'age', 'position', 'subject_areas.description', 'sex', 'category')
                            ->orderBy('number_of_attended_training', 'asc')
                            ->distinct()
                            ->get();       
                                                                    
        $this->teaching_positions = PositionCategory::where('category', 'Teaching')->get();
        $this->non_teaching_positions = PositionCategory::where('category', 'Non-Teaching')->get();
        $this->teaching_related_positions = PositionCategory::where('category', 'Teaching Related')->get();                     
        
        return view('livewire.admin.created-training-info', ['selected_participant' => $selected_participant, 'recommended_participant' => $recommended_participant, 'profiles' => $profiles, 'created_otp' => $created_otp, 'training_info' => $training_info, 'criterias' => $criterias, 'other_training_selected' => $other_training_selected]);
    }

    public function selectUser($employee_id){

        $values0 = [
            'employee_id' => $employee_id,
            'training_id'=> $this->training_id,
        ];

        $query1 = SelectedParticipant::create($values0);
    }

    public function removeUser($employee_id){

        $query1 = SelectedParticipant::where('employee_id', $employee_id)->where('training_id', $this->training_id)->delete();
        
    }

    public function deleteOTP($date_created)
    {
        $this->date_created = $date_created;
        $query = otp::where('date_created', $this->date_created);
            if ($query->delete()){
                session()->flash('success', 'Deleted Successfully!');
            }       
            session()->flash('failed', 'Delete Failed!');
    }

    public function FinishTraining(){

        $query = OfficialTraining::where('training_id', $this->training_id)->update(['status' => 1]);

        if ($query){

            SelectedParticipant::where('training_id', $this->training_id)->delete();
            RecommendedParticipant::where('training_id', $this->training_id)->delete();
            Criteria::where('training_id', $this->training_id)->delete();
            otp::where('training_id', $this->training_id)->delete();

            return redirect('/admin/dashboard/ongoing-training');
        }
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
