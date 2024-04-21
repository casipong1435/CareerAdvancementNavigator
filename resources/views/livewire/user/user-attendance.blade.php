<div class="row">
    <div class="col-md-12 mb-2">
        <button class="btn btn-primary" onclick="history.back()">Go back</button>
    </div>
    <div class="py-2 d-flex justify-content-end">
        <div>Training ID: <strong>{{ $training_info->training_id }}</strong></div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="shadow rounded">
            <div class="p-1 text-center fw-bold border-bottom" style="background: #ffcc41;">{{ $training_info->training_title }}</div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Start of Conduct:</div>
                <div class="fw-bold">{{ $training_info->start_of_conduct }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>End of Conduct:</div>
                <div class="fw-bold">{{ $training_info->end_of_conduct }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>number of Hours:</div>
                <div class="fw-bold">{{ $training_info->number_of_hours }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Learning Development:</div>
                <div class="fw-bold">{{ $training_info->type_of_ld }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Source of Budget:</div>
                <div class="fw-bold">{{ $training_info->source_of_budget }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Conducted By:</div>
                <div class="fw-bold">{{ $training_info->conducted_by }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Service Provider:</div>
                <div class="fw-bold">{{ $training_info->service_provider }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Number of Participants:</div>
                <div class="fw-bold">{{ $training_info->number_of_participants }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Venue:</div>
                <div class="fw-bold">{{ $training_info->venue }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Training Type:</div>
                <div class="fw-bold">{{ $training_info->training_type }}</div>
            </div>
            <div>
                @if (!$attended_training)
                    @if (count($attendance) >= $number_of_days)
                        <button type="button" class="w-100 rounded-0 btn btn-success" wire:click.prevent="FininshTrainingAttendance()">Finish Training</button>
                    @endif
                @else
                    <button type="button" class="w-100 rounded-0 btn btn-secondary disabled">Added</button>
                @endif
            </div>
        </div>
    </div>

    <!-- User Attendance Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">User Attendance</div>
        <div class="">
            <table cellpadding="2">
                <thead style="background: #ffcc41">
                    <th>#</th>
                    <th>Training ID</th>
                    <th>Log Time</th>
                </thead>
                <tbody id="user-div" style="background: #fde6a6">
                    <?php $i = 1; ?>
                @if (count($attendance) > 0)
                    @foreach ($attendance as $my_attendance)
                        <tr class="user-data-{{ $my_attendance->employee_id }}" id="user-data">
                            <td data-label="ID">{{ $i++ }}</td>
                            <td data-label="Training ID">{{ $my_attendance->training_id }}</td>
                            <td data-label="Log Time">{{ ucfirst($my_attendance->logged_in) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center p-3">You haven't submitted an attendance to this training yet!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="py-2">
                <span class="fs-5">Total Attendance Submitted: <strong>{{ count($attendance).' / '.$number_of_days }}</strong></span>
            </div>
        </div>
    </div>
</div>
