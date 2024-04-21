<div class="row">
    @if (session()->has('success'))
        <div class="p-3 message">
            <div class="alert alert-success alert-dismissible fade show message" role="alert">
                <strong>Success!</strong> Criteria Set
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="py-2 d-flex justify-content-between">
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
                <div>Reference:</div>
                <div class="fw-bold">{{ $training_info->reference }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="shadow rounded">
            <div class="p-1 text-center fw-bold border-bottom" style="background: #ffc954;">Set Criteria</div>
            <div class="container">
                <form wire:submit.prevent="setCriteria">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 border px-2 mb-3 position-relative" id="subject_area_checkbox_container">
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
                            @if (auth()->user()->position == 'EPS')
                                <div class="position-absolute block_subject"></div>
                            @endif
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

    <!-- Subordinate List User List Table -->
    <div class="col-md-12 mt-4">
        <div class="h2">Subordinate List</div>
        <span class="filter d-flex flex-row d-inline-block mb-2">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="subordinate_sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="subordinate_search_input" placeholder="Search...">
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
                <tbody id="recommended-div">
                    <?php $j = 1; ?>
                @if (count($profiles) > 0)
                    @foreach ($profiles as $profile)
                    <tr id="recommended-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $profile->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($profile->first_name)." ".ucfirst($profile->last_name) }}</td>
                        <td data-label="Age">{{ $profile->age }}</td>
                        <td data-label="Position">{{ strtoupper($profile->position) }}</td>
                        <td data-label="Subject Area">
                            @if ($profile->description)
                                {{ ucfirst($profile->description) }}
                            @else
                                None
                            @endif
                        </td>
                        <td data-label="Sex">{{ ucfirst($profile->sex) }}</td>
                        <td data-label="Attended Training">{{ $profile->number_of_attended_training }}</td>
                        <td data-label="Action" class="d-block py-2">
                            <button type="button" class="btn btn-success" wire:click.prevent="recommendUser({{ $profile->employee_id }},{{ $training_info->training_id }})">Recommend</button>
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
        <div class="h2">Recommended Users</div>
        <span class="filter d-flex flex-row d-inline-block mb-2">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="recommend_sortBy">
                    <option selected disabled>Sort By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="recommend_orderBy">
                    <option selected disabled>Order By</option>
                    <option value="users.employee_id">Employee ID</option>
                    <option value="first_name">Name</option>
                    <option value="age">Age</option>
                    
                </select>
                <select class="mx-1" wire:model.live="recommend_sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="recommended_search_input" placeholder="Search...">
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
                    <th>Sex</th>
                    <th>Action</th>
                </thead>
                <tbody id="recommended-div">
                    <?php $j = 1; ?>
                @if (count($recommended_participants) > 0)
                    @foreach ($recommended_participants as $recommend_user)
                    <tr id="recommended-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $recommend_user->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($recommend_user->first_name)." ".ucfirst($recommend_user->last_name) }}</td>
                        <td data-label="Age">{{ $recommend_user->age }}</td>
                        <td data-label="Position">{{ strtoupper($recommend_user->position) }}</td>
                        <td data-label="Sex">{{ ucfirst($recommend_user->sex) }}</td>
                        <td data-label="Action" class="d-block py-2">
                            <button type="button" class="btn btn-danger" wire:key="{{ $recommend_user->id }}" wire:click.prevent="unRecommendUser({{ $recommend_user->employee_id }},{{ $training_info->training_id }})">Remove</button>
                        </td>
                        @if (session()->has('msg'))
                            <div class="alert alert-success fade show message">
                                <strong>{{ session()->get('msg') }}</strong>
                            </div>
                        @endif
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="7" class="text-center p-3">No Recommended User Yet!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
