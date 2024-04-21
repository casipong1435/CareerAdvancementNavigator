<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\Profiles;
use App\Models\SubjectArea;
use App\Models\CareerService;
use App\Models\EducationalAttainment;
use App\Models\GradeLevelTaught;
use Livewire\Component;
use App\Models\PositionCategory;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotifications;

class PendingAccount extends Component
{
    public $pending_search_input = "";
    public $pending_sortBy = "asc";
    public $pending_position = null;
    public $pending_category = null;
    public $pending_sex = null;

    public $rejected_search_input = "";
    public $rejected_sortBy = "asc";
    public $rejected_position = null;
    public $rejected_category = null;
    public $rejected_sex = null;

    public $employee_id;

    public function render()
    {

         $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($this->pending_position, function($query){
                                $query->where('users.position', $this->pending_position);
                            })
                            ->when($this->pending_category, function($query){
                                $query->where('users.category', $this->pending_category);
                            })
                            ->when($this->pending_sex, function($query){
                                $query->where('profiles.sex', $this->sex);
                            })->where(function($query){
                                $query->search('users.employee_id', $this->pending_search_input)
                                ->search('users.employee_id', $this->pending_search_input)
                                ->search('profiles.first_name', $this->pending_search_input)
                                ->search('profiles.last_name', $this->pending_search_input)
                                ->search('profiles.sex', $this->pending_search_input)
                                ->search('users.position', $this->pending_search_input)
                                ->search('users.category', $this->pending_search_input);
                            })
                            ->orderBy('users.position', $this->pending_sortBy)
                            ->where('users.status', 0)
                            ->where('users.role', 0)
                            ->get();

        $rejected_accounts = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($this->rejected_position, function($query){
                               $query->where('users.position', $this->rejected_position);
                            })
                            ->when($this->rejected_category, function($query){
                                $query->where('users.category', $this->rejected_category);
                             })
                             ->when($this->rejected_sex, function($query){
                                $query->where('profiles.sex', $this->sex);
                            })->where(function($query){
                                $query->search('users.employee_id', $this->rejected_search_input)
                                ->search('users.employee_id', $this->rejected_search_input)
                                ->search('profiles.first_name', $this->rejected_search_input)
                                ->search('profiles.last_name', $this->rejected_search_input)
                                ->search('profiles.sex', $this->rejected_search_input)
                                ->search('users.position', $this->rejected_search_input)
                                ->search('users.category', $this->rejected_search_input);
                            })
                            ->orderBy('users.position', $this->rejected_sortBy)
                            ->where(function($query){
                                $query->where('users.status', 2)
                                ->where('users.role', 0);
                            })->get();

        $pending_category_values = PositionCategory::distinct()->get(['category']);

        $pending_position_values = PositionCategory::distinct()->when($this->pending_category, function($query){
                                                    $query->where('category', $this->pending_category);
                                                })
                                                ->whereNotIn('position', ['HR', 'SEPS', 'EPS-II'])
                                                ->get('position');

        $rejected_category_values = PositionCategory::distinct()->get(['category']);

        $rejected_position_values = PositionCategory::distinct()->when($this->rejected_category, function($query){
                                                    $query->where('category', $this->rejected_category);
                                                })
                                                 ->whereNotIn('position', ['HR', 'SEPS', 'EPS-II'])
                                                 ->get('position');

        return view('livewire.admin.pending-account', ['employees' => $employees, 'rejected_accounts' => $rejected_accounts, 'pending_category_values' => $pending_category_values, 'pending_position_values' => $pending_position_values, 'rejected_category_values' => $rejected_category_values, 'rejected_position_values' => $rejected_position_values]);
    }

    public function CancelRejection($employee_id){
        User::where('employee_id', $employee_id)->update(['status' => 0]);
    }

    public function DeleteAccount($employee_id){
        User::where('employee_id', $employee_id)->delete();
        Profiles::where('employee_id', $employee_id)->delete();
        SubjectArea::where('employee_id', $employee_id)->delete();
        CareerService::where('employee_id', $employee_id)->delete();
        EducationalAttainment::where('employee_id', $employee_id)->delete();
        GradeLevelTaught::where('employee_id', $employee_id)->delete();
    }

    public function sendEmail($recipient, $name, $description){
        $email = new EmailNotifications($name, $description);
        Mail::to($recipient)->send($email);
    }

    public function clickModalID($employee_id){
        $this->employee_id = $employee_id;
    }

    public function rejectUser($employee_id){
        try{
            User::where('employee_id', $employee_id)->update(['status' => 2]);
            session()->flash('success', 'User Rejected!');
            $user = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->where('users.employee_id', $employee_id)->first(['first_name', 'last_name', 'email']);
            $description = 'We regret to inform you that your account registration has been rejected. If you believe this is an error, please contact our support team at [careeradvancementnavigator@gmail.com] for further assistance. Thank you.';
            $name = ucfirst($user->first_name).' '.ucfirst($user->last_name);
            $this->sendEmail($user->email, $name, $description);
            
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }

    public function acceptUser(){
        try{
            User::where('employee_id', $this->employee_id)->update(['status' =>  1, 'job_status' => 1]);
            session()->flash('success', 'User Accepted!');
            $this->dispatch('hide:modal');
            $user = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->where('users.employee_id', $this->employee_id)->first(['first_name', 'last_name', 'email']);
            $description = 'Good news! Your account has been successfully verified. It is our pleasure to serve you.';
            $name = ucfirst($user->first_name).' '.ucfirst($user->last_name);
            $this->sendEmail($user->email, $name, $description);
            
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
