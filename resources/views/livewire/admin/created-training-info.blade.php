<div class="row">
    <?php 
        use Carbon\Carbon; 
    ?>
    @if (session()->has('success'))
        <div class="p-3 message">
            <div class="alert alert-success alert-dismissible fade show message" role="alert">
                <strong>Success!</strong> Criteria Set
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="py-2 d-flex justify-content-between">
        <button type="button" class="border-0 p-2 text-white shadow qr-button" data-bs-toggle="modal" data-bs-target="#qr-code-modal"><i class="bi bi-qr-code"></i></button>  
        <div>Training ID: <strong>{{ $training_info->training_id }}</strong></div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="shadow rounded">
            <div class="p-1 text-center fw-bold border-bottom position-relative" style="background: #ad96ff;">
                <div class="fs-4 position-absolute edit-training">
                    <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#edit-training"></i>
                </div>
                {{ $training_info->training_title }}
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Start of Training:</div>
                <div class="fw-bold">{{ $training_info->start_of_conduct }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>End of Training:</div>
                <div class="fw-bold">{{ $training_info->end_of_conduct }}</div>
            </div>
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Number of Hours:</div>
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
            <div class="d-flex justify-content-between flex-row p-2 mb-1">
                <div>Reference:</div>
                <div class="fw-bold">{{ $training_info->reference }}</div>
            </div>

            @php
                $today = Carbon::now()->toDateString();
            @endphp

            @if ($training_info->end_of_conduct < $today)
                <button type="button" class="w-100 rounded-0 btn btn-success" wire:confirm='Note: The selected, recommended participants, One Time Pins, and the criteria for this training will be deleted.' wire:click.prevent="FinishTraining()">Finished</button>
            @endif
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="shadow rounded">
            <div class="p-1 text-center fw-bold border-bottom" style="background: #ffc954;">Set Criteria</div>
            <div class="container">
                <form wire:submit.prevent="setCriteria">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 border px-2 mb-3" id="subject_area_checkbox_container">
                            <label for="" class="text-center fw-bold">Subject Area</label>
                            <br>
                                <input type="checkbox" value="Filipino" wire:model="criteria_subject_area" id="Filipino" class="subject_area_checkbox me-2"><label for="Filipino" id="Filipino">Filipino</label>
                                <br>
                                <input type="checkbox" value="English" wire:model="criteria_subject_area" id="English" class="subject_area_checkbox me-2"><label for="English" id="English">English</label>
                                <br>
                                <input type="checkbox" value="Mathematics" wire:model="criteria_subject_area" id="Mathematics" class="subject_area_checkbox me-2"><label for="Mathematics" id="Mathematics">Mathematics</label>
                                <br>
                                <input type="checkbox" value="Science" wire:model="criteria_subject_area" id="Science" class="subject_area_checkbox me-2"><label for="Science" id="Science">Science</label>
                                <br>
                                <input type="checkbox" value="MAPEH" wire:model="criteria_subject_area" id="MAPEH" class="subject_area_checkbox me-2"><label for="MAPEH" id="MAPEH">MAPEH</label>
                                <br>
                                <input type="checkbox" value="Ar-Pan" wire:model="criteria_subject_area" id="Ar-Pan" class="subject_area_checkbox me-2"><label for="Ar-Pan" id="Ar-Pan">Ar-Pan</label>
                                <br>                                
                                <input type="checkbox" value="TLE" wire:model="criteria_subject_area" id="TLE" class="subject_area_checkbox me-2"><label for="TLE" id="TLE">TLE</label>
                                <br>
                                <input type="checkbox" value="ESP" wire:model="criteria_subject_area" id="ESP" class="subject_area_checkbox me-2"><label for="ESP" id="ESP">ESP</label>
                            <br>
                        </div>
                        <div class="col-md-4 border px-2 mb-3">
                            <div id="age_radio_container">
                                <label for="" class="fw-bold">Age</label>
                                <br>
                                <input type="radio" value="17-65" id="all" wire:model="criteria_age"  class="me-2"><label for="all" id="all">All</label>
                                <br>
                                <input type="radio" value="18-25" id="18-25" wire:model="criteria_age"  class="me-2"><label for="18-25" id="18-25">18-25</label>
                                <br>
                                <input type="radio" value="26-35" id="26-35" wire:model="criteria_age" class="me-2"><label for="26-35" id="26-35">26-35</label>
                                <br>
                                <input type="radio" value="36-45" id="36-45" wire:model="criteria_age" class="me-2"><label for="36-45" id="6-45">36-45</label>
                                <br>
                                <input type="radio" value="46-55" id="46-55" wire:model="criteria_age" class="me-2"><label for="46-55" id="46-55">46-55</label>
                                <br>
                                <input type="radio" value="56-65" id="56-65" wire:model="criteria_age" class="me-2"><label for="56-65" id="56-65">56-65</label>
                                <br>
                            </div>
                            <br>
                            <div id="sex_radio_container">
                                <label class="fw-bold">Sex</label>
                                <br>
                                <input type="radio" value="" id="all" wire:model="criteria_sex" class="me-2"><label for="all" id="all">All</label>
                                <br>
                                <input type="radio" value="male" id="male" wire:model="criteria_sex" class="me-2"><label for="male" id="male">Male</label>
                                <br>
                                <input type="radio" value="female" id="female" wire:model="criteria_sex" class="me-2"><label for="female" id="female">Female</label>
                            </div>
                        </div>
                        <div class="col-md-4 border px-2 mb-3" id="position_checkbox_container">
                            <label for="" class="text-center fw-bold">Category</label>
                            <br>
                            <input type="checkbox" value="Teaching" id="teaching" wire:model="criteria_category"  class="me-2"><label for="teaching" id="teaching">Teaching</label>
                            <br>
                                <details class="multiple-select1 my-1">
                                    <summary>Select multiple</summary>
                                    <div class="multiple-select-dropdown">
                                        @foreach ($teaching_positions as $position)
                                            <label>
                                                <input type="checkbox" hidden wire:model="criteria_position" value="{{ $position->position }}">
                                                <span class="content">{{ $position->position }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>  
                                <br>
                            <input type="checkbox" value="Non-Teaching" id="non-teaching" wire:model="criteria_category" class="me-2"><label for="non-teaching" id="non-teaching">Non Teaching</label>
                                <br>
                                <details class="multiple-select2 my-1">
                                    <summary>Select multiple</summary>
                                    <div class="multiple-select-dropdown">
                                        @foreach ($non_teaching_positions as $position)
                                            <label>
                                                <input type="checkbox" hidden wire:model="criteria_position" value="{{ $position->position }}">
                                                <span class="content">{{ $position->position }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>  
                                <br>
                            <input type="checkbox" value="Teaching Related" id="Teaching Related" wire:model="criteria_category" class="me-2"><label for="Teaching Related" id="Teaching Related">Teaching Related</label>
                            <br>
                                <details class="multiple-select3 my-1">
                                    <summary>Select multiple</summary>
                                    <div class="multiple-select-dropdown">
                                        @foreach ($teaching_related_positions as $position)
                                            <label>
                                                <input type="checkbox" hidden wire:model="criteria_position" value="{{ $position->position }}">
                                                <span class="content">{{ $position->position }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>  
                            <br>
                            <br>
                            <div id="sex_radio_container">
                                <label class="fw-bold">Educational Level</label>
                                <br>
                                <input type="radio" value="" id="all" wire:model="criteria_level" class="me-2"><label for="all" id="all">All</label>
                                <br>
                                <input type="radio" value="3" id="doctorate" wire:model="criteria_level" class="me-2"><label for="doctorate" id="doctorate">Doctoral</label>
                                <br>
                                <input type="radio" value="2" id="masteral" wire:model="criteria_level" class="me-2"><label for="masteral" id="masteral">Masteral</label>
                                <br>
                                <input type="radio" value="1" id="baccalaureate" wire:model="criteria_level" class="me-2"><label for="baccalaureate" id="baccalaureate">Baccalaureate</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary w-100 rounded-0">Set Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="shadow rounded">
            <div class="p-1 text-center fw-bold border-bottom" style="background: #ffc954;">Generate OTP</div>
            <div class="p-2">
                <form action="{{ route('generateotp') }}" method="POST">
                    @csrf
                    <div class="form-group p-2">
                        <label for="date_created">Date For:</label>
                        <br>
                        <input type="date" name="date_created" class="p-2 w-100 mb-2" id="date_created" required>
                        <label for="otp_count">Enter OTP count (Max 10)</label>
                        <br>
                        <input type="hidden" name="training_id" value="{{ $training_info->training_id }}">
                        <input type="number" name="otp_count" id="otp_count" class="p-2 w-100" min="1" max="10" value="0" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9 mb-3">
        <div class="shadow rounded">
            <div class="container" id="otp-div">
                <div class="row" id="otp-reloader">
                    @foreach ($created_otp as $otp)
                        <div class="col-md-4 otp-file" id="otp_{{ $otp->date_created }}">
                            <div class="p-2 position-relative otp-file">
                                <span class="fw-bold">OTP ({{ $otp->date_created }})</span>
                                <br>
                                <a href="{{ route('printotp', $otp->date_created) }}" style="font-size: 8rem">
                                    <i class="bi bi-file-earmark"></i>
                                </a>
                                <a wire:click="deleteOTP('{{$otp->date_created}}')" class="position-absolute remove-otp"><i class="bi bi-x"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- User List Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">List of employees available for training</div>
        <span class="filter d-flex justify-content-end mb-2">
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="userlist_search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
        <div class="">
            <table cellpadding="2">
                <thead>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Position</th>
                    <th>Subject Area</th>
                    <th>Sex</th>
                    <th>Attended Training</th>
                    <th>Action</th>
                </thead>
                <tbody id="user-div">
                    <?php $i = 1; ?>
                @if (count($profiles) > 0)
                
                    @foreach ($profiles as $profile)
                    <?php
                        $user_id = [
                            'id' => Crypt::encrypt($profile->employee_id)
                        ]
                    ?>
                    <tr class="user-data-{{ $profile->employee_id }}" id="user-data">
                        <td data-label="ID">{{ $i++ }}</td>
                        <td data-label="Employee ID"><a href="{{ route('viewuserprofile', $user_id) }}" target="_blank" class="text-decoration-none fw-bold" style="color: #7752dd">{{ $profile->employee_id }}</a></td>
                        <td data-label="Name">{{ ucfirst($profile->first_name)." ".ucfirst($profile->last_name) }}</td>
                        <td data-label="Age">{{ $profile->age }}</td>
                        <td data-label="Position">{{ $profile->position }}</td>
                        <td data-label="Subject Area">{{ $profile->description }}</td>
                        <td data-label="Sex">{{ $profile->sex }}</td>
                        <td data-label="Attended Training">{{ $profile->number_of_attended_training }}</td>
                        <td data-label="Action" class="d-block py-2">
                           <button type="button" class="btn btn-success {{ count($selected_participant) == $training_info->number_of_participants ? 'disabled':'' }}" wire:click="selectUser({{ $profile->employee_id }})">Select</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="9" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recommended User List Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">Recommended by officials</div>
        <span class="filter d-flex flex-row d-inline-block mb-2">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="recommendeduser_orderBy">
                    <option selected disabled>Order By</option>
                    <option value="employee_id">Employe ID</option>
                    <option value="first_name">Name</option>
                    <option value="position">Position</option>
                    <option value="age">Age</option>
                    <option value="subject_areas.description">Subject Area</option>
                    <option value="recommended_participants.recommended_by">Recommended By</option>
                </select>
                <select class="mx-1" wire:model.live="recommendeduser_sex">
                    <option selected disabled>Sort</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="recommendeduser_position">
                    <option selected disabled>Position</option>
                    <option value="">All</option>
                    <option value="teaching">Teaching</option>
                    <option value="non-teaching">Non-Teaching</option>
                    <option value="eps">EPS</option>
                    <option value="psds">PSDS</option>
                    <option value="sds">SDS</option>
                    <option value="osds">OSDS Unit Heads</option>
                    <option value="school-head">School Heads</option>
                </select>
                <select class="mx-1" wire:model.live="recommendedby">
                    <option selected disabled>Position</option>
                    <option value="">All</option>
                    <option value="eps">EPS</option>
                    <option value="psds">PSDS</option>
                    <option value="sds">SDS</option>
                    <option value="osds">OSDS Unit Heads</option>
                    <option value="school-head">School Heads</option>
                </select>
                <select class="mx-1" wire:model.live="recommendeduser_sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="recommendeduser_search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
        <div class="">
            <table cellpadding="2">
                <thead>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Position</th>
                    <th>Subject Area</th>
                    <th>Sex</th>
                    <th>Attended Training</th>
                    <th>Recommended By</th>
                    <th>Action</th>
                </thead>
                <tbody id="recommended-div">
                    <?php $j = 1; ?>
                @if (count($recommended_participant) > 0)
                    @foreach ($recommended_participant as $profile)
                    <tr class="user-data-{{ $profile->employee_id }}" id="recommended-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $profile->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($profile->first_name)." ".ucfirst($profile->last_name) }}</td>
                        <td data-label="Age">{{ $profile->age }}</td>
                        <td data-label="Position">{{ strtoupper($profile->position) }}</td>
                        <td data-label="Subject Area">{{ ucfirst($profile->description) }}</td>
                        <td data-label="Sex">{{ ucfirst($profile->sex) }}</td>
                        <td data-label="Attended Training">{{ $profile->number_of_attended_training }}</td>
                        <td data-label="Recommended By">{{ $profile->recommended_by }}</td>
                        <td data-label="Action" class="d-block py-2">
                            <button type="button" class="btn btn-success" wire:click="selectUser({{ $profile->employee_id }})">Select</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="10" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Selected Participants Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">Selected Participants</div>
        <span class="filter d-flex flex-row d-inline-block mb-2">
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
                <select class="mx-1" wire:model.live="selecteduser_position">
                    <option selected disabled>Position</option>
                    <option value="">All</option>
                    <option value="teaching">Teaching</option>
                    <option value="non-teaching">Non-Teaching</option>
                    <option value="eps">EPS</option>
                    <option value="psds">PSDS</option>
                    <option value="sds">SDS</option>
                    <option value="osds">OSDS Unit Heads</option>
                    <option value="school-head">School Heads</option>
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
                    <th>Position</th>
                    <th>Sex</th>
                    <th>Action</th>
                </thead>
                <tbody id="participant-div">
                    <?php $j = 1; ?>
                @if (count($selected_participant) > 0)
                    @foreach ($selected_participant as $participant)
                    <tr class="selected-data-{{ $participant->employee_id }}" id="participant-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $participant->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($participant->first_name)." ".ucfirst($participant->last_name) }}</td>
                        <td data-label="Age">{{ $participant->age }}</td>
                        <td data-label="Position">{{ $participant->position }}</td>
                        <td data-label="Sex">{{ $participant->sex }}</td>
                        <td data-label="Action" class="d-block py-2">
                            <button type="button" class="btn btn-danger" wire:click="removeUser({{ $participant->employee_id }})">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="7" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="mt-1">
            <div class="d-flex align-items-center flex-row">
                <span>Total: {{ count($selected_participant) }} / {{ $training_info->number_of_participants }}</span>
                @if(count($selected_participant) > 0)
                    <a target="_blank" href="{{ route('printSelectedParticipants', ['training_id' => $training_id]) }}" class=" text-decoration-none p-2 rounded" style="color: #5461D4;"><i class="bi bi-file-earmark-arrow-down-fill fs-1"></i></a>
                @endif
            </div>
        </div>
    </div>

    <!-- Selected Participants Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">List of employees attended a training</div>
        <span class="filter d-flex flex-row d-inline-block mb-2">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="attended_orderBy">
                    <option selected disabled>Order By</option>
                    <option value="employee_id">Employe ID</option>
                    <option value="first_name">Name</option>
                    <option value="position">Position</option>
                    <option value="age">Age</option>
                </select>
                <select class="mx-1" wire:model.live="attended_sortBy">
                    <option selected disabled>Sort By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="attended_position">
                    <option selected disabled>Position</option>
                    <option value="">All</option>
                    <option value="teaching">Teaching</option>
                    <option value="non-teaching">Non-Teaching</option>
                    <option value="eps">EPS</option>
                    <option value="psds">PSDS</option>
                    <option value="sds">SDS</option>
                    <option value="osds">OSDS Unit Heads</option>
                    <option value="school-head">School Heads</option>
                </select>
                <select class="mx-1" wire:model.live="attended_sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="attended_search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
        <div class="">
            <table cellpadding="8" >
                <thead>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Sex</th>
                    <th>Training Title</th>
                    <th>Training Date</th>
                </thead>
                <tbody id="participant-div">
                    <?php $j = 1; ?>
                @if (count($other_training_selected) > 0)
                    @foreach ($other_training_selected as $participant)
                    <tr class="selected-data-{{ $participant->employee_id }}" id="participant-data">
                        <td data-label="#">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $participant->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($participant->first_name)." ".ucfirst($participant->last_name) }}</td>
                        <td data-label="Position">{{ $participant->position }}</td>
                        <td data-label="Sex">{{ $participant->sex }}</td>
                        <td data-label="Training Title">{{ $participant->training_title }}</td>
                        <td data-label="Training Date">{{ ucfirst($participant->start_of_conduct).' - '.ucfirst($participant->end_of_conduct) }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="7" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="mt-1">
            <div class="d-flex align-items-center flex-row">
                <span>Total: {{ count($other_training_selected) }}</span>
            </div>
        </div>
    </div>


    <!-- QR Code Modal-->
<div class="modal fade" id="qr-code-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">Attendance QR</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4 text-center">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(255)->generate(route('attendance'))) !!}">
        </div>
        <div class="modal-footer">
            <a href="{{ route('downloadQR') }}" target="_blank" class="btn btn-primary"><i class="bi bi-download"></i></a>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Training Modal -->
<form action="{{ route('adminEditTraining', $training_info->training_id) }}" method="POST" id="admin_edit_training">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit-training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Add Training</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Training ID</label>
                                <input type="text" class="p-2 mb-2 w-100" value="{{ $training_info->training_id }}" placeholder="Enter Here" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Training Title</label>
                                <input type="text" name="training_title" class="p-2 mb-2 w-100" value="{{ $training_info->training_title }}" placeholder="Enter Here" required>
                                <div class="text-danger message error-text training_title_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="start-date">Started of Training</label>
                                <input type="date" min="1900-01-01"  name="start_of_conduct" class="p-2 mb-2 w-100" value="{{ $training_info->start_of_conduct }}" id="start-date" required>
                                <div class="text-danger message error-text start_of_conduct_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="end-date">Ended of Training</label>
                                <input type="date" min="1900-01-01"  name="end_of_conduct" class="p-2 mb-2 w-100" value="{{ $training_info->end_of_conduct }}" id="end-date" required>
                                <div class="text-danger message error-text end_of_conduct_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Number of Hours</label>
                                <input type="text" name="number_of_hours" class="p-2 mb-2 w-100" value="{{ $training_info->number_of_hours }}" placeholder="(ex. 24)" disabled>
                                <div class="text-danger message error-text number_of_hours_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">No. of Participants</label>
                                <input type="number" min="1" name="number_of_participants" class="p-2 mb-2 w-100" value="{{ $training_info->number_of_participants }}" required>
                                <div class="text-danger message error-text number_of_participants_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Training Type</label>
                                <select name="training_type" id="" class="training_type p-2 mb-2 w-100">
                                    @if ($training_info->training_type)
                                        <option value="{{ $training_info->training_type }}">{{ $training_info->training_type }}</option>
                                    @endif
                                    <option value="GAD">GAD</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="other_training_type" class="training_type p-2 mb-2 w-100 d-none" placeholder="Specify Here...">
                                <div class="text-danger message error-text training_type_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label for="">Conducted By</label>
                                <select name="conducted_by"  class="conducted_by p-2 mb-2 w-100">
                                    @if ($training_info->conducted_by)
                                        <option value="{{ $training_info->conducted_by }}">{{ $training_info->conducted_by }}</option>
                                    @endif
                                    <option value="SGOD">SGOD</option>
                                    <option value="CID">CID</option>
                                    <option value="OSDS">OSDS</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="other_conducted_by" class="conducted_by p-2 mb-2 w-100 d-none" placeholder="Specify Here...">
                                <div class="text-danger message error-text conducted_by_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Type of Learning Development</label>
                                <select name="type_of_ld" class="type_of_ld p-2 mb-2 w-100" required>
                                    <option disabled>Select</option>
                                    @if ($training_info->type_of_ld)
                                        <option value="{{ $training_info->type_of_ld }}">{{ $training_info->type_of_ld }}</option>
                                    @endif
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="other_type_of_ld" class="type_of_ld p-2 mb-2 w-100 d-none" placeholder="Specify Here...">
                                <div class="text-danger message error-text type_of_ld_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Source of Budget</label>
                                <select name="source_of_budget" class="source_of_budget p-2 mb-2 w-100" required>
                                    <option disabled>Select</option>
                                    @if ($training_info->source_of_budget)
                                        <option selected value="{{ $training_info->source_of_budget }}">{{ $training_info->source_of_budget }}</option>
                                    @endif
                                    <option value="School - MOOE">School - MOOE</option>
                                    <option value="Division - MOOE">Division - MOOE</option>
                                    <option value="HRD Fund">HRD Fund</option>
                                    <option value="GAD Fund">GAD Fund</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="other_source_of_budget" class="source_of_budget p-2 mb-2 w-100 d-none" placeholder="Specify Here...">
                                <div class="text-danger message error-text source_of_budget_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Type of Service Provider</label>
                                <select name="service_provider" class="service_provider p-2 mb-2 w-100" required>
                                    <option disabled>Select</option>
                                    @if ($training_info->service_provider)
                                    <option selected value="{{ $training_info->service_provider }}">{{ $training_info->service_provider }}</option>
                                    @endif
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="other_service_provider" class="service_provider p-2 mb-2 w-100 d-none" placeholder="Specify Here...">
                                <div class="text-danger message error-text service_provider_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Responsible Unit</label>
                                <input type="text" name="responsible_unit" class="p-2 mb-2 w-100" value="{{ $training_info->responsible_unit }}" required>
                                <div class="text-danger message error-text responsible_unit_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Venue</label>
                                <input type="text" name="venue" class="p-2 mb-2 w-100" value="{{ $training_info->venue }}" required>
                                <div class="text-danger message error-text venue_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Reference</label>
                                <input type="text" name="reference" class="p-2 mb-2 w-100" value="{{ $training_info->reference }}" required>
                                <div class="text-danger message error-text venue_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Save" class="btn btn-success">
                <input type="reset" value="Cancel" class="btn btn-secondary" data-bs-dismiss="modal">
            </div>
          </div>
        </div>
      </div>
</form>

</div>
