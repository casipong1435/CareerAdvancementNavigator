<div>
    <!-- User List Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">User Attendance</div>
        <div class="py-2 d-flex justify-content-between">
            <div class="add-btn">
                <button class="border-0 p-2 rounded text-white report_button" data-bs-toggle="modal" data-bs-target="#generate-report-modal" style="background: #ffcc41"><i class="bi bi-file-earmark fs-1"></i></button>
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
        <div class="mt-2">
            <table cellpadding="2">
                <thead style="background: #ffcc41">
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Position</th>
                    <th>District</th>
                    <th>School</th>
                    <th>Log Time</th>
                </thead>
                <tbody id="user-div" style="background: #fde6a6">
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
                        <td data-label="School">{{ $attendance->school }}</td>
                        <td data-label="Log Time">{{ Carbon\Carbon::parse($attendance->logged_in)->format('d-M-Y  g:i A' ) }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="9" class="text-center p-3">No Attendees Yet</td>
                    </tr>
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

    <div wire:ignore.self class="modal fade" id="generate-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Generate Report</h5>
                    <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="generateReport">
                <div class="modal-body p-4">
                    <div class="col-md-12 p-2 mb-1">
                        <div class="form-group text-center p-2 mb-2">
                            <span class="fs-5">From: </span>
                            <input type="date" wire:model="from" class="p-2 w-100" min="{{ $training_info->start_of_conduct }}" max="{{ $training_info->end_of_conduct }}">
                            @error('from')
                                <div class="text-danger message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group text-center p-2">
                            <span class="fs-5">To: </span>
                            <input type="date" wire:model="to" class="p-2 w-100" min="{{ $training_info->start_of_conduct }}" max="{{ $training_info->end_of_conduct }}">
                            @error('to')
                                <div class="text-danger message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    @if (session()->has('found-report'))
                        <div class="col-md-12 px-3">
                            <div class="alert alert-success fade show alert-dismissable position-relative">
                                <strong>Found! </strong> {{ session()->get('found-report') }}
                                <a target="_blank" href="{{ route('printAttendance', ['from' => $from, 'to' => $to, 'training_id' => $training_id]) }}" class=" text-decoration-none p-2 rounded position-absolute" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></a>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('fail'))
                        <div class="col-md-12 px-3">
                            <div class="alert alert-danger fade show alert-dismissable position-relative">
                                <strong>No Data! </strong> {{ session()->get('fail') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="col-md-12 px-3 message">
                            <div class="alert alert-danger fade show alert-dismissable position-relative">
                                <strong>Error! </strong> {{ session()->get('error') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Generate</button>
                </div>
            </form>
            </div>
        </div>
    </div>

</div>
