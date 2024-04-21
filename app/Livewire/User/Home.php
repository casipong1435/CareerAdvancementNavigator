<?php

namespace App\Livewire\User;

use App\Models\AttendedTraining;
use App\Models\OfficialTraining;
use App\Models\PendingTraining;
use App\Models\SelectedParticipant;
use Livewire\Component;

use Carbon\Carbon;

class Home extends Component
{
    public $selecteduser_search_input = '';
    public $employee_id;
    public $today;

    public function mount(){
        $this->employee_id = auth()->user()->employee_id;
        $this->today = Carbon::now('Asia/Manila');
    }
    public function render()
    {
        $pending_training = PendingTraining::where('employee_id', $this->employee_id)->get();
        $attended_training = AttendedTraining::where('employee_id', $this->employee_id)->get();

        $count_pending_training = count($pending_training);
        $count_attended_training = count($attended_training);

        $ongoing_training = OfficialTraining::leftJoin('selected_participants', 'official_trainings.training_id', '=', 'selected_participants.training_id')
                                ->where('status', 0)
                                ->where('employee_id', $this->employee_id)
                                ->first();

        return view('livewire.user.home', ['count_pending_training' => $count_pending_training, 'count_attended_training' => $count_attended_training,'ongoing_training' => $ongoing_training]);
    }
}
