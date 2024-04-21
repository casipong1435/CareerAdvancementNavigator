<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use Carbon\Carbon;

use DB;

class GadReport extends Component
{
    public $search_input = "";
    public $sortBy = "asc";
    public $orderBy = "start_of_conduct";

    public $from = '';
    public $to = '';
    public $year;
    
    public function render()
    {
        if($this->from){
            $this->year = Carbon::createFromFormat('Y-m-d', $this->from)->format('Y');
        }

        $official_trainings = OfficialTraining::select([
                            'official_trainings.training_id',
                            'official_trainings.training_title',
                            'official_trainings.start_of_conduct',
                            'official_trainings.end_of_conduct',
                            'official_trainings.number_of_hours',
                            'official_trainings.type_of_ld',
                            'official_trainings.source_of_budget',
                            'official_trainings.responsible_unit',
                            \DB::raw('ROUND(SUM(salary_grades.salary / 22) * (official_trainings.number_of_hours)) as budget'),
                        ])
                            ->leftJoin('attended_trainings', 'official_trainings.training_id', '=', 'attended_trainings.training_id')
                            ->leftJoin('profiles', 'attended_trainings.employee_id', '=', 'profiles.employee_id')
                            ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
                            ->leftJoin('salary_grades', 'users.position', '=', 'salary_grades.position')
                            ->whereIn('official_trainings.conducted_by', ['SGOD', 'CID', 'OSDS'])
                            ->where('official_trainings.status', 1)
                            ->groupBy([
                                'official_trainings.training_id',
                                'official_trainings.training_title',
                                'official_trainings.start_of_conduct',
                                'official_trainings.end_of_conduct',
                                'official_trainings.number_of_hours',
                                'official_trainings.type_of_ld',
                                'official_trainings.source_of_budget',
                                'official_trainings.responsible_unit',
                            ])
                            ->withCount('attendedTrainings')
                            ->withCount([
                                'attendedTrainings as male_count' => function ($query) {
                                    $query->whereHas('employee', function ($query) {
                                        $query->where('sex', 'male');
                                    });
                                },
                                'attendedTrainings as female_count' => function ($query) {
                                    $query->whereHas('employee', function ($query) {
                                        $query->where('sex', 'female');
                                    });
                                }
                            ])
                            ->where(function($query){
                                $query->search('training_title', $this->search_input)
                                ->search('training_id', $this->search_input)
                                ->search('number_of_hours', $this->search_input)
                                ->search('start_of_conduct', $this->search_input)
                                ->search('end_of_conduct', $this->search_input);
                            })
                            ->where(function($query){
                                $query->where('start_of_conduct', '>=', $this->from);
                            })
                            ->where(function($query){
                                $query->where('start_of_conduct', '<=', $this->to);
                            })
                            ->having(\DB::raw('COUNT(attended_trainings.id)'), '>', 0) // Ensures at least one attendee
                            ->orderBy('official_trainings.start_of_conduct', 'asc')
                            ->get();

        if (count($official_trainings) > 0){
            session()->flash('found', true);
        }

        return view('livewire.admin.gad-report', ['official_trainings' => $official_trainings]);
    }
}
