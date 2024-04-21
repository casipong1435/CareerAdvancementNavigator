<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\PositionCategory;
use Auth;

class SubordinateList extends Component
{
    public $orderBy = "first_name";
    public $sortBy = "asc";
    public $sex = null;
    public $search_input = "";

    public function render()
    {
        $user = Auth::user()->employee_id;
        $userdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->where('users.employee_id', $user)->first(['description', 'district', 'school', 'position']);

        switch ($userdata->position){
            case 'EPS':
                $subuserdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->leftJoin('subject_areas', 'users.employee_id', '=', 'subject_areas.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->search_input)
                            ->search('profiles.first_name', $this->search_input)
                            ->search('profiles.last_name', $this->search_input)
                            ->search('profiles.sex', $this->search_input)
                            ->search('users.position', $this->search_input)
                            ->search('profiles.district', $this->search_input)
                            ->search('profiles.school', $this->search_input);
                        })
                        ->when($this->sex, function($query){
                            $query->where('profiles.sex', $this->sex);
                        })
                        ->where('users.position', 'Teaching')->whereIn('subject_areas.description', [$userdata->description])
                        ->orderBy($this->orderBy, $this->sortBy)->get();
                break;

            case 'PSDS':
                $subuserdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                    ->where(function($query){
                        $query->search('profiles.employee_id', $this->search_input)
                        ->search('profiles.first_name', $this->search_input)
                        ->search('profiles.last_name', $this->search_input)
                        ->search('profiles.sex', $this->search_input)
                        ->search('users.position', $this->search_input)
                        ->search('profiles.district', $this->search_input)
                        ->search('profiles.school', $this->search_input);
                    })
                    ->when($this->sex, function($query){
                        $query->where('profiles.sex', $this->sex);
                    })
                    ->where('users.category', 'Teaching')->where('profiles.district', $userdata->district)
                    ->orderBy($this->orderBy, $this->sortBy)->get();
                break;

            case 'SDS':
                $subuserdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->search_input)
                            ->search('profiles.first_name', $this->search_input)
                            ->search('profiles.last_name', $this->search_input)
                            ->search('profiles.sex', $this->search_input)
                            ->search('users.position', $this->search_input)
                            ->search('profiles.district', $this->search_input)
                            ->search('profiles.school', $this->search_input);
                        })
                        ->when($this->sex, function($query){
                            $query->where('profiles.sex', $this->sex);
                        })
                        ->where('users.category', 'Teaching')
                        ->orderBy($this->orderBy, $this->sortBy)->get();
                break;

            case 'OSDS':
                $subuserdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->search_input)
                            ->search('profiles.first_name', $this->search_input)
                            ->search('profiles.last_name', $this->search_input)
                            ->search('profiles.sex', $this->search_input)
                            ->search('users.position', $this->search_input)
                            ->search('profiles.district', $this->search_input)
                            ->search('profiles.school', $this->search_input);
                        })
                        ->when($this->sex, function($query){
                            $query->where('profiles.sex', $this->sex);
                        })
                        ->where('users.category', 'Non Teaching')
                        ->orderBy($this->orderBy, $this->sortBy)->get();
                break;

            case 'School Head':
                $subuserdata = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->where(function($query){
                            $query->search('profiles.employee_id', $this->search_input)
                            ->search('profiles.first_name', $this->search_input)
                            ->search('profiles.last_name', $this->search_input)
                            ->search('profiles.sex', $this->search_input)
                            ->search('users.position', $this->search_input)
                            ->search('profiles.district', $this->search_input)
                            ->search('profiles.school', $this->search_input);
                        })
                        ->when($this->sex, function($query){
                            $query->where('profiles.sex', $this->sex);
                        })
                        ->whereIn('users.position', ['Teaching', 'Non Teaching'])
                        ->where('profiles.school', $userdata->school)
                        ->orderBy($this->orderBy, $this->sortBy)->get();
                break;
        }

        return view('livewire.user.subordinate-list', ['subuserdata' => $subuserdata]);
    }
}
