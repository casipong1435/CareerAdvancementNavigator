<?php

namespace App\Livewire\Admin;
use App\Models\PendingTraining;
use App\Models\AttendedTraining;
use App\Models\OfficialTraining;
use App\Mail\EmailNotifications;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Livewire\Component;

class VerifyTraining extends Component
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
    public $number_of_participants;
    public $venue;
    public $training_type;
    public $reference;
    public $id;

    public $today;

    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render()
    {
        
         $pending_trainings = PendingTraining::leftJoin('profiles', 'pending_trainings.employee_id', '=', 'profiles.employee_id')
                                ->where(function($query){
                                $query->search('training_title', $this->pending_search_input)
                                ->search('number_of_hours', $this->pending_search_input)
                                ->search('start_of_conduct', $this->pending_search_input)
                                ->search('end_of_conduct', $this->pending_search_input);
                            })
                            ->orderBy($this->pending_orderBy, $this->pending_sortBy)
                            ->where('status', 0)
                            ->get(['training_id', 'training_title', 'start_of_conduct', 'end_of_conduct', 'source_of_budget', 'conducted_by', 'type_of_ld', 'number_of_participants', 'service_provider', 'responsible_unit', 'venue', 'training_type','pending_trainings.id', 'pending_trainings.employee_id', 'first_name', 'last_name', 'number_of_hours']);

        $rejected_trainings = PendingTraining::leftJoin('profiles', 'pending_trainings.employee_id', '=', 'profiles.employee_id')
                                ->where(function($query){
                                $query->search('training_title', $this->rejected_search_input)
                                ->search('number_of_hours', $this->rejected_search_input)
                                ->search('start_of_conduct', $this->rejected_search_input)
                                ->search('end_of_conduct', $this->rejected_search_input);
                            })
                            ->orderBy($this->rejected_orderBy, $this->rejected_sortBy)
                            ->where('status', 2)
                            ->get(['training_id', 'training_title', 'start_of_conduct', 'end_of_conduct', 'source_of_budget', 'conducted_by', 'type_of_ld', 'number_of_participants', 'service_provider', 'responsible_unit', 'venue', 'training_type','pending_trainings.id', 'pending_trainings.employee_id', 'first_name', 'last_name', 'number_of_hours']);

        return view('livewire.admin.verify-training', ['pending_trainings' => $pending_trainings, 'rejected_trainings' => $rejected_trainings]);
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
        PendingTraining::where('id', $id)->update(['status' => 2]);
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
        $this->number_of_participants = $training->number_of_participants;
        $this->venue = $training->venue;
        $this->training_type = $training->training_type;
        $this->id = $training->id;
        $this->reference = $training->reference;
    }

    public function acceptTraining($id){
        $training = PendingTraining::where('id', $id)->first();
        try{

            $user = User::leftJoin('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->where('users.employee_id', $training->employee_id)->first(['first_name', 'last_name', 'email']);
            $description = 'Great news! Your requested additional training has been verified and successfully added to your account. Happy learning!';
            $name = ucfirst($user->first_name).' '.ucfirst($user->last_name);


            if ($training->training_id != null || $training->training_id != ''){

                $attended_value = [
                    'employee_id' => $training->employee_id,
                    'training_id' => $training->training_id,
                    'cop' => $training->cop
                ];
               
                AttendedTraining::create($attended_value);
                PendingTraining::where('id', $id)->delete();
                session()->flash('success', 'Training Accepted!');
                $this->dispatch('hide:modal');
                $this->sendEmail($user->email, $name, $description);
            }else{
                PendingTraining::where('id', $id)->update(['status'=> 1]);
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