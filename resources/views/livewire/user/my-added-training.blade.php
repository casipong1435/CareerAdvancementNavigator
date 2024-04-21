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

    <div class="py-2 d-flex added-filter">
        <div class="add-btn">
            <button class="add-user-btn m-1" data-bs-toggle="modal" data-bs-target="#add_training_modal">+</button>
            <button class="border-0 p-2 rounded text-white report_button m-1" data-bs-toggle="modal" data-bs-target="#generate-report-modal" style="background: #665cee"><i class="bi bi-file-earmark fs-3"></i></button>
        </div>
        <span class="filter d-flex d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="orderBy" name="orderBy">
                    <option selected disabled>Order By</option>
                    <option value="start_of_conduct">Start of Training</option>
                    <option value="end_of_conduct">End of Training</option>
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
        <th>Title</th>
        <th>Duration</th>
        <th>Training Date</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
    @if (count($pending_trainings) > 0)
        @foreach ($pending_trainings as $pending_training)
            <tr id="pending_training_{{ $pending_training->id }}">
                <td data-label="Title">{{ $pending_training->training_title }}</td>
                <td data-label="Duration">{{ $pending_training->number_of_hours }} hours</td>
                <td data-label="Date of Conduct">{{ $pending_training->start_of_conduct.' - '. $pending_training->end_of_conduct }}</td>         
                <td data-label="Status">
                    @if ($pending_training->status == 0)
                        <span class="bg-warning">Pending</span>
                    @elseif($pending_training->status == 1)
                        <span class="bg-success">Accepted</span>
                    @else
                        <span class="bg-danger">Rejected</span>
                    @endif
                </td>
                <td data-label="Action" class="d-block py-2">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-pending-training{{ $pending_training->id }}"><i class="bi bi-eye"></i></button>
                    @if ($pending_training->status == 0)
                        <button wire:confirm="Are you sure you want to delete this unverified training?" wire:click="deleteUnverifiedTraining({{ $pending_training->id }}, '{{ $pending_training->cop }}')" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                    @endif
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
<span class="fs-5 mt-1">Total: </span>{{ count($pending_trainings) }}
</div>

@foreach ($pending_trainings as $pending_training)

<div class="modal fade" id="view-pending-training{{ $pending_training->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">Training Information</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="img-holder">
                                <img src="{{ asset('storage/certificates/'.$pending_training->cop) }}" data="{{ $pending_training->id }}" class="profile-pic mb-2" style="cursor: pointer" id="img-sizable">
                            </div>
                        </div>
                        <div class="text-center mb-2">Certificate of Participation</div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <span class="fw-bold">Title</span>
                    <input class="p-2 mb-2 w-100" name="training_title" value="{{ $pending_training->training_title }}" disabled>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <span class="fw-bold">Start of Training</span>
                      <input class="p-2 mb-2 w-100" name="start_of_conduct" value="{{ $pending_training->start_of_conduct }}" disabled>
                      <span class="fw-bold">End of Training</span> 
                      <input class="p-2 mb-2 w-100" name="end_of_conduct" value="{{ $pending_training->end_of_conduct }}" disabled>
                      <span class="fw-bold">Number of Hours</span> 
                      <input class="p-2 mb-2 w-100" name="number_of_hours" value="{{ $pending_training->number_of_hours }}" disabled>
                      <span class="fw-bold">Service Provider</span> 
                      <input class="p-2 mb-2 w-100" name="service_provider" value="{{ $pending_training->service_provider }}" disabled>
                      <span class="fw-bold">Number of Participants</span> 
                      <input class="p-2 mb-2 w-100" name="number_of_participants" value="{{ $pending_training->number_of_participants }}" disabled>
                    </div>
                    <div class="col-md-6">
                      <span class="fw-bold">Type of LD</span>
                      <input class="p-2 mb-2 w-100" name="type_of_ld" value="{{ $pending_training->type_of_ld }}" disabled>
                      <span class="fw-bold">Source of Budget</span>
                      <input class="p-2 mb-2 w-100" name="source_of_budget" value="{{ $pending_training->source_of_budget }}" disabled>
                      <span class="fw-bold">Conducted By</span>
                      <input class="p-2 mb-2 w-100" name="conducted_by" value="{{ $pending_training->conducted_by }}" disabled>
                      <span class="fw-bold">Responsible Unit</span> 
                      <input class="p-2 mb-2 w-100" name="responsible_unit" value="{{ $pending_training->responsible_unit }}" disabled>
                      <span class="fw-bold">Venue</span> 
                      <input class="p-2 mb-2 w-100" name="venue" value="{{ $pending_training->venue }}" disabled>
                    </div>
                    <div class="col-md-12">
                        <span class="fw-bold">Training type</span>
                        <input class="p-2 mb-2 w-100" name="type_of_ld" value="{{ $pending_training->training_type }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>

<div class="zoom-photo--{{ $pending_training->id }} d-none" id="zoom-photo">
    @if ($pending_training->cop)
    <img src="{{ asset('storage/certificates/'.$pending_training->cop) }}" id="zoomed-img">
    @endif
    <span class="close-icon" data="{{ $pending_training->id }}"><i class="bi bi-x-circle"></i></span>  
</div>

@endforeach

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
                        <input type="date" wire:model="from" class="p-2 w-100">
                        @error('from')
                            <div class="text-danger message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center p-2">
                        <span class="fs-5">To: </span>
                        <input type="date" wire:model="to" class="p-2 w-100">
                        @error('to')
                            <div class="text-danger message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if (session()->has('found-report'))
                    <div class="col-md-12 px-3">
                        <div class="alert alert-success fade show alert-dismissable position-relative">
                            <strong>Found! </strong> {{ session()->get('found-report') }}
                            <a target="_blank" href="{{ route('pdfaddedtraining', ['from' => $from, 'to' => $to, 'employee_id' => $employee_id]) }}" class=" text-decoration-none p-2 rounded position-absolute" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></a>
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

@include('partials.addtraining')
</div>
