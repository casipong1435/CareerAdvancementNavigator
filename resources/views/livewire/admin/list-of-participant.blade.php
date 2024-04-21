<div>
    <div class="container">
        <div class="row">
            <div class="py-2 d-flex justify-content-end">
                <div>Training ID: <strong>{{ $training_id }}</strong></div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="shadow rounded">
                    <div class="p-1 text-center fw-bold border-bottom" style="background: #ad96ff;">{{ $training_info->training_title }}</div>
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
                        <div>No. of Participant:</div>
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
                </div>
            </div>

            <!-- User List Table -->
            <div class="col-md-12 mt-4">
                <div class="h2">User Attended</div>
                <div class="py-1 d-flex justify-content-between">
                    <div class="add-btn">
                        <a href="{{ route('printTrainingParticipants', $training_id) }}" target="_blank" class="p-3 rounded text-white report_button text-decoration-none" style="background: #ad96ff"><i class="bi bi-file-earmark fs-3"></i></a>
                    </div>
                    <span class="filter d-flex flex-row d-inline-block">
                        <div class="mx-2 d-flex justify-content-center align-items-center">
                            <span class="filter">Filter: </span>
                            <select class="mx-1" wire:model.live="sortBy" name="sort">
                                <option selected disabled>Sort</option>
                                <option value="ASC">Ascending</option>
                                <option value="DESC">Descending</option>
                            </select>
                            <select class="mx-1" wire:model.live="position" name="position">
                                <option selected value="">All</option>
                                <option value="teaching">Teaching</option>
                                <option value="non-teaching">Non-Teaching</option>
                                <option value="eps">EPS</option>
                                <option value="psds">PSDS</option>
                                <option value="sds">SDS</option>
                                <option value="osds">OSDS Unit Heads</option>
                                <option value="school-head">School Heads</option>
                            </select>
                            <select class="mx-1" wire:model.live="sex" name="sex">
                                <option selected disabled>Sex</option>
                                <option value="">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
            
                            <?php $i = 1; ?>
                            <select class="mx-1" wire:model.live="district" name="district">
                                <option selected disabled>District</option>
                                <option value="">All</option>
                                <?php while ($i <= 10) { ?>
                                    <option value="{{ $i }}">{{ $i }}</option>
                                <?php $i++; } ?>
                            </select>
                        </div>
                        <div class="search position-relative mx-2">
                            <input type="text" wire:model.live="search_input" placeholder="Search...">
                            <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
                        </div>
                    </span>
                </div>
                <div>
                    <table cellpadding="2">
                        <thead style="background: #ad96ff">
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Position</th>
                            <th>District</th>
                        </thead>
                        <tbody id="user-div" style="background: #ffffff">
                        @php
                            $i = 1;
                        @endphp
                        @if (count($user_attended) > 0)
                            @foreach ($user_attended as $attendance)

                            <?php
                                $user_id = [
                                    'id' => Crypt::encrypt($attendance->employee_id)
                                ]
                            ?>
                            <tr class="user-data-{{ $attendance->employee_id }}" id="user-data">
                                <td data-label="ID">{{ $i++ }}</td>
                                <td data-label="Employee ID"><a href="{{ route('viewuserprofile', $user_id) }}" target="_blank">{{ $attendance->employee_id }}</a></td>
                                <td data-label="Name">{{ ucfirst($attendance->first_name)." ".ucfirst($attendance->last_name) }}</td>
                                <td data-label="Age">{{ $attendance->age }}</td>
                                <td data-label="Sex">{{ $attendance->sex }}</td>
                                <td data-label="Position">{{ $attendance->position }}</td>
                                <td data-label="District">{{ $attendance->district }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="py-2">
                        <span class="fs-5">Total Attendee: </span>{{ count($user_attended) }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
