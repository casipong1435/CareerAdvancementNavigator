<?php

namespace App\Livewire;
use App\Models\PendingTraining;
use App\Models\AttendedTraining;
use App\Models\OfficialTraining;
use App\Mail\EmailNotifications;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Livewire\Component;

class PendingTrainingList extends Component
{
    public $pending_search_input = "";
    public $pending_sortBy = "asc";
    public $pending_orderBy = "start_of_conduct";

    public $rejected_search_input = "";
    public $rejected_sortBy = "asc";
    public $rejected_orderBy = "start_of_conduct";

    public $image;
    public $training_id;
    public $employee_id;
    public $training_title;
    public $start_of_conduct;
    public $end_of_conduct;
    public $number_of_hours;
    public $type_of_ld;
    public $source_of_budget;
    public $conducted_by;
    public $service_provider;
    public $responsible_unit;
    public $id;

    public $today;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render()
    {
        
         $pending_trainings = PendingTraining::where(function($query){
                                $query->search('training_title', $this->pending_search_input)
                                ->search('number_of_hours', $this->pending_search_input)->where('status', 0)
                                ->search('start_of_conduct', $this->pending_search_input)->where('status', 0)
                                ->search('end_of_conduct', $this->pending_search_input)->where('status', 0);
                            })
                            ->orderBy($this->pending_orderBy, $this->pending_sortBy)
                            ->where(function($query){
                                $query->where('status', 0);
                            })->get();

        $rejected_trainings = PendingTraining::where(function($query){
                                $query->search('training_title', $this->rejected_search_input)
                                ->search('number_of_hours', $this->rejected_search_input)->where('status', 1)
                                ->search('start_of_conduct', $this->rejected_search_input)->where('status', 1)
                                ->search('end_of_conduct', $this->rejected_search_input)->where('status', 1);
                            })
                            ->orderBy($this->rejected_orderBy, $this->rejected_sortBy)
                            ->where(function($query){
                                $query->where('status', 1);
                            })->get();

        return view('livewire.admin.pending-training-list', ['pending_trainings' => $pending_trainings, 'rejected_trainings' => $rejected_trainings]);
    }

    public function CancelTrainingRejection($id){
        PendingTraining::where('id', $id)->update(['status' => 0]);
    }

    public function DeleteRejectedTraining($id){
        PendingTraining::where('id', $id)->delete();
    }

    
    public function sendEmail($recipient, $name, $description){
        $email = new EmailNotifications($name, $description);
        Mail::to($recipient)->send($email);
    }

    public function RejectTraining($id, $employee_id){
        PendingTraining::where('id', $id)->update(['status' => 1]);
        $user = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                    ->where('users.employee_id', $employee_id)->first(['first_name', 'last_name', 'email']);
        $description = 'We regret to inform you that your requested additional training has been rejected. If you believe this is an error, please contact our support team at [careeradnvancementnavigator@gmail.com] for further assistance. Thank you!';
        $name = ucfirst($user->first_name).' '.ucfirst($user->last_name);
        $this->sendEmail($user->email, $name, $description);
    }

    public function pendingTrainingInfo($id){
        $training = PendingTraining::where('id', $id)->first();

        $this->image = $training->cop;
        $this->training_id = $training->training_id;
        $this->employee_id = $training->employee_id;
        $this->training_title = $training->training_title;
        $this->start_of_conduct = $training->start_of_conduct;
        $this->end_of_conduct = $training->end_of_conduct;
        $this->number_of_hours = $training->number_of_hours;
        $this->type_of_ld = $training->type_of_ld;
        $this->source_of_budget = $training->source_of_budget;
        $this->conducted_by = $training->conducted_by;
        $this->service_provider = $training->service_provider;
        $this->responsible_unit = $training->responsible_unit;
        $this->id = $training->id;
    }

    public function acceptTraining(){
        $this->validate([
            "training_id" => 'required|numeric',
            "responsible_unit" => 'required',
        ]);

        try{
            $user = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->where('users.employee_id', $this->employee_id)->first(['first_name', 'last_name', 'email']);
            $description = 'Great news! Your requested additional training has been verified and successfully added to your account. Happy learning!';
            $name = ucfirst($user->first_name).' '.ucfirst($user->last_name);

            $check_trainingID_if_exist = OfficialTraining::where('training_id', $this->training_id)
                                                        ->where('start_of_conduct', $this->start_of_conduct)
                                                        ->where('end_of_conduct', $this->end_of_conduct)
                                                        ->count();

            if ($check_trainingID_if_exist > 0){

                $attended_value = [
                    'employee_id' => $this->employee_id,
                    'training_id' => $this->training_id,
                    'cop' => $this->image
                ];

                AttendedTraining::create($attended_value);
                PendingTraining::where('id', $this->id)->delete();
                session()->flash('success', 'Trainging Accepted!');
                $this->dispatch('hide:modal');
                $this->sendEmail($user->email, $name, $description);
            }else{

                $attended_value = [
                    'employee_id' => $this->employee_id,
                    'training_id' => $this->training_id,
                    'cop' => $this->image
                ];
        
                $official_value = [
                    'training_id' => $this->training_id,
                    'training_title' => $this->training_title,
                    'start_of_conduct' => $this->start_of_conduct,
                    'end_of_conduct' => $this->end_of_conduct,
                    'number_of_hours' => $this->number_of_hours,
                    'source_of_budget' => $this->source_of_budget,
                    'service_provider' => $this->service_provider,
                    'responsible_unit' => $this->responsible_unit,
                    'type_of_ld' => $this->type_of_ld,
                    'conducted_by' => $this->conducted_by,
                    'status' => 1
                ];

                AttendedTraining::create($attended_value);
                OfficialTraining::create($official_value);
                PendingTraining::where('id', $this->id)->delete();
                session()->flash('success', 'Trainging Accepted!');
                $this->dispatch('hide:modal');
                $this->sendEmail($user->email, $name, $description);
            }


        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
            $this->dispatch('hide:modal');
        }

    }
}