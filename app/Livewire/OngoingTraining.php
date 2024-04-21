<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\attendance;
use App\Models\RecommendedParticipant;
use App\Models\SelectedParticipant;
use App\Models\AttendedTraining;
use App\Models\otp;

use Carbon\Carbon;

class OngoingTraining extends Component
{
    public $training_id;

    public $today;


    public function mount(){
        $this->today = Carbon::now('Asia/Manila')->toDateString();
    }

    public function render()
    {
        $ongoing_trainings = OfficialTraining::where('status', 0)
                                            ->where('start_of_conduct', '<=', $this->today)
                                ->orderBy('start_of_conduct', 'asc')->get();
        return view('livewire.admin.ongoing-training', ['ongoing_trainings' => $ongoing_trainings]);
    }

    public function deleteID($training_id){
        $this->training_id = $training_id;
    }

    public function deleteOngoinTraining(){
        OfficialTraining::where('training_id', $this->training_id)->delete();
        attendance::where('training_id', $this->training_id)->delete();
        RecommendedParticipant::where('training_id', $this->training_id)->delete();
        SelectedParticipant::where('training_id', $this->training_id)->delete();
        AttendedTraining::where('training_id', $this->training_id)->delete();
        otp::where('training_id', $this->training_id)->delete();
    }


}
