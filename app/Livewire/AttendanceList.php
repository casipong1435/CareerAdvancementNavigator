<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OfficialTraining;
use App\Models\attendance;

class AttendanceList extends Component
{

    public function render()
    {
        $trainings = OfficialTraining::orderBy('start_of_conduct', 'asc')->get();
        return view('livewire.admin.attendance-list', ['trainings' => $trainings]);
    }

}
