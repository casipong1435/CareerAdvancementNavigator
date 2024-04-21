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
        
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <button class="add-user-btn" data-bs-toggle="modal" data-bs-target="#add_training_modal">+</button>
        </div>
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="orderBy" name="orderBy">
                    <option selected disabled>Order By</option>
                    <option value="start_of_conduct">Date Started</option>
                    <option value="end_of_conduct">Date Ended</option>
                    <option value="training_title">Title</option>
                    <option value="number_of_hours">Hours</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
    </div>
    <div class="table-holder">
    <table cellpadding="2">
    <thead>
        <th>#</th>
        <th>Training ID</th>
        <th>Title</th>
        <th>Duration</th>
        <th>Date of Conduct</th>
        <th>Action</th>
    </thead>
    <tbody>
    @if (count($attended_trainings) > 0)
        @foreach ($attended_trainings as $attended_training)
            <tr>
                <td data-label="ID">{{ $attended_training->id }}</td>
                <td data-label="Training ID">{{ $attended_training->training_id }}</td>
                <td data-label="Title">{{ $attended_training->training_title }}</td>
                <td data-label="Duration">{{ $attended_training->number_of_hours }} hours</td>
                <td data-label="Date of Conduct">{{ $attended_training->start_of_conduct.' - '. $attended_training->end_of_conduct }}</td>         
                <td data-label="Action" class="d-block py-2">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-my-training{{ $attended_training->training_id }}"><i class="bi bi-eye"></i></button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td data-label="Training" colspan="6" class="text-center">No Training Added Yet.</td>
        </tr>
    @endif
    </tbody>
</table>
<span class="fs-5 t-3">Total: </span>{{ count($attended_trainings) }}
</div>
@include('partials.viewtraining')
</div>
