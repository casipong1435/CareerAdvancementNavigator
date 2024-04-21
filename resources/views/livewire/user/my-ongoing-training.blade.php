<div>
    @if ($ongoing_training)
    <div class="py-2 d-flex justify-content-between">
        <div>Training ID: <strong>{{ $ongoing_training->training_id }}</strong></div>
    </div>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="shadow rounded">
                        <div class="p-1 text-center fw-bold border-bottom" style="background: #ad96ff;">
                            {{ $ongoing_training->training_title }}
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Start of Training:</div>
                            <div class="fw-bold">{{ $ongoing_training->start_of_conduct }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>End of Training:</div>
                            <div class="fw-bold">{{ $ongoing_training->end_of_conduct }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Number of Hours:</div>
                            <div class="fw-bold">{{ $ongoing_training->number_of_hours }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Learning Development:</div>
                            <div class="fw-bold">{{ $ongoing_training->type_of_ld }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Source of Budget:</div>
                            <div class="fw-bold">{{ $ongoing_training->source_of_budget }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Conducted By:</div>
                            <div class="fw-bold">{{ $ongoing_training->conducted_by }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Service Provider:</div>
                            <div class="fw-bold">{{ $ongoing_training->service_provider }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Number of Participants:</div>
                            <div class="fw-bold">{{ $ongoing_training->number_of_participants }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Venue:</div>
                            <div class="fw-bold">{{ $ongoing_training->venue }}</div>
                        </div>
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Reference:</div>
                            <div class="fw-bold">{{ $ongoing_training->reference }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="shadow rounded">
                        <div class="p-1 text-center fw-bold border-bottom" style="background: #ecb743;">
                            My Attendance
                        </div>
                        @if (count($attendance) > 0)
                            @foreach ($attendance as $myattendance)
                                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                                    <div>Log Time:</div>
                                    <div class="fw-bold">{{ $myattendance->logged_in }}</div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-group text-center p-2">
                                <div>you haven't submitted your attendance yet.</div>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between flex-row p-2 mb-1">
                            <div>Total Attendance Submitted:</div>
                            <div class="fw-bold">{{ count($attendance) }} / {{ $number_of_days }}</div>
                        </div>
                        <div>
                            @if (!$attended_training)
                                @if (count($attendance) >= $number_of_days)
                                    <button type="button" class="w-100 rounded-0 btn btn-success" wire:click.prevent="FininshTrainingAttendance()">Finish Training</button>
                                @else
                                    <a href="{{ route('attendance') }}" class="w-100 rounded-0 btn btn-primary">Submit Attendance</a>
                                @endif
                            @else
                                <button type="button" class="w-100 rounded-0 btn btn-secondary disabled">Added</button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    

    <!-- Selected Participants Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">Selected Participants</div>
        <span class="filter d-flex d-inline-block mb-2">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="selecteduser_orderBy">
                    <option selected disabled>Order By</option>
                    <option value="employee_id">Employe ID</option>
                    <option value="first_name">Name</option>
                    <option value="position">Position</option>
                    <option value="age">Age</option>
                </select>
                <select class="mx-1" wire:model.live="selecteduser_sortBy">
                    <option selected disabled>Sort By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="selecteduser_sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="selecteduser_search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
        <div class="">
            <table cellpadding="2" >
                <thead>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Position Grade</th>
                    <th>Sex</th>
                </thead>
                <tbody id="participant-div">
                    <?php $j = 1; ?>
                @if (count($selected_participant) > 0)
                    @foreach ($selected_participant as $participant)
                    <tr class="selected-data-{{ $participant->employee_id }} {{ $participant->employee_id == $employee_id ? 'bg-warning':'' }}" id="participant-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $participant->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($participant->first_name)." ".ucfirst($participant->last_name) }}</td>
                        <td data-label="Age">{{ $participant->age }}</td>
                        <td data-label="Position">{{ $participant->position }}</td>
                        <td data-label="Sex">{{ $participant->sex }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="6" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="mt-1">
            <div class="d-flex align-items-center flex-row">
                <span>Total: {{ count($selected_participant) }} / {{ $ongoing_training->number_of_participants }}</span>
                @if(count($selected_participant) > 0)
                    <a target="_blank" href="{{ route('printSelectedParticipants', ['training_id' => $ongoing_training->training_id]) }}" class=" text-decoration-none p-2 rounded" style="color: #5461D4;"><i class="bi bi-file-earmark-arrow-down-fill fs-1"></i></a>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="col-md-12 p-2 text-center">
        <h2>No Ongoing Training Yet.</h2>
    </div>
    @endif
</div>
