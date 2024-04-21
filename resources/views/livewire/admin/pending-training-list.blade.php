<div>
    @if (session()->has('success'))
            <div class="p-3 message">
                <div class="alert alert-success alert-dismissible fade show message" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-3 message">
                <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                    <strong>Error!</strong> {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

    <div class="py-2 d-flex justify-content-end">
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="pending_sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="pending_orderBy" name="orderBy">
                    <option selected disabled>Order By</option>
                    <option value="start_of_conduct">Date Started</option>
                    <option value="end_of_conduct">Date Ended</option>
                    <option value="training_title">Title</option>
                    <option value="number_of_hours">Hours</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="pending_search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
    </div>
    <div class="table-holder">
    <table cellpadding="2">
        <thead>
            <th>#</th>
            <th>Employee ID</th>
            <th>Training ID</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Date of Conduct</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if (count($pending_trainings) > 0)
                    @foreach ($pending_trainings as $pending_training)
                    <?php
                        $user_id = [
                            'id' => Crypt::encrypt($pending_training->employee_id)
                        ]
                    ?>
                        <tr class="pending-training-{{ $pending_training->id  }}">
                            <td data-label="ID">{{ $pending_training->id }}</td>
                            <td data-label="Employee ID"><a href="{{ route('viewuserprofile', $user_id) }}" target="_blank">{{ $pending_training->employee_id }}</a></td>
                            <td data-label="Training ID">{{ $pending_training->training_id }}</td>
                            <td data-label="Title">{{ $pending_training->training_title }}</td>
                            <td data-label="Duration">{{ $pending_training->number_of_hours }} hours</td>
                            <td data-label="Date of Conduct">{{ $pending_training->start_of_conduct.' - '. $pending_training->end_of_conduct }}</td>         
                            <td data-label="Action" class="d-block py-2">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#view-pending-training" wire:click="pendingTrainingInfo({{ $pending_training->id }})"><i class="bi bi bi-check-circle"></i></button>
                                <button class="btn btn-danger" wire:click.prevent="RejectTraining({{ $pending_training->id }}, '{{ $pending_training->employee_id }}')">
                                    <div wire:loading wire:target="RejectTraining({{ $pending_training->id }}, '{{ $pending_training->employee_id }}')">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                      </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                                        <path d="M15 8a6.973 6.973 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8ZM2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Pending Training" colspan="7" class="text-center">No Pending Training Added Yet.</td>
                    </tr>
                @endif
        </tbody>
    </table>
    <span class="fs-5 mt-3">Total: </span>{{ count($pending_trainings) }}
    
    <div class="row mt-3">
        <h3>Rejected Training</h3>
        <div class="py-2 d-flex justify-content-end">
            <span class="filter d-flex flex-row d-inline-block">
                <div class="mx-2 d-flex justify-content-center align-items-center">
                    <span class="filter">Filter: </span>
                    <select class="mx-1" wire:model.live="rejected_sortBy" name="sort">
                        <option selected disabled>Sort</option>
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                    <select class="mx-1" wire:model.live="rejected_orderBy" name="orderBy">
                        <option selected disabled>Order By</option>
                        <option value="start_of_conduct">Date Started</option>
                        <option value="end_of_conduct">Date Ended</option>
                        <option value="training_title">Title</option>
                        <option value="number_of_hours">Hours</option>
                    </select>
                </div>
                <div class="search position-relative mx-2">
                    <input type="text" wire:model.live="rejected_search_input" placeholder="Search...">
                    <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
                </div>
            </span>
        </div>
        <div class="table-holder">
        <table cellpadding="2">
            <thead>
                <th>#</th>
                <th>Employee ID</th>
                <th>Training ID</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Date of Conduct</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if (count($rejected_trainings) > 0)
                        @foreach ($rejected_trainings as $training)
                            <tr class="pending-training-{{ $training->id  }}">
                                <td data-label="ID">{{ $training->id }}</td>
                                <td data-label="Employee ID">{{ $training->employee_id }}</td>
                                <td data-label="Training ID">{{ $training->training_id }}</td>
                                <td data-label="Title">{{ $training->training_title }}</td>
                                <td data-label="Duration">{{ $training->number_of_hours }} hours</td>
                                <td data-label="Date of Conduct">{{ $training->start_of_conduct.' - '. $training->end_of_conduct }}</td>         
                                <td data-label="Action" class="d-block py-2">
                                    <button class="btn btn-secondary" wire:click.prevent="CancelTrainingRejection({{ $training->id }})">Cancel</button>
                                    <button class="btn btn-danger" wire:confirm="Are you sure you want to delete this rejected training?" wire:click.prevent="DeleteRejectedTraining({{ $training->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td data-label="Pending Training" colspan="7" class="text-center">No Rejected Training.</td>
                        </tr>
                    @endif
            </tbody>
        </table>
        <span class="fs-5 mt-3">Total: </span>{{ count($rejected_trainings) }}
        </div>
    </div>
</div>
@include('partials.pendingtraining_modal')
</div>
