<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\AttendedTraining;
use App\Models\SubjectArea;
use App\Models\CareerService;
use App\Models\school;
use App\Models\EducationalAttainment;
use Illuminate\Database\Query\Builder;

use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function($view){
            if (Auth::check()){
                $employee_id = Auth::user()->employee_id;
                $employee_data = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                                     ->where('users.employee_id', $employee_id)->first();

                $added_subject_area = SubjectArea::where('employee_id', $employee_id)->get();

                $school_data = school::get();

                $view->with(['employee_data' => $employee_data, 'added_subject_area' => $added_subject_area,'school_data' => $school_data]);
            }
        });

        Builder::macro('search', function($field, $string){
            return $string ? $this->orWhere($field, 'like', '%'.$string.'%') : $this;
        });
    }
}
