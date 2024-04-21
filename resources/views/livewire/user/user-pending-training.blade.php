<div>
    <div class="py-2 d-flex justify-content-between">
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
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
    @if (count($pending_trainings) > 0)
        @foreach ($pending_trainings as $pending_training)
            <tr id="pending_training_{{ $pending_training->id }}">
                <td data-label="ID">{{ $pending_training->id }}</td>
                <td data-label="Training ID">{{ $pending_training->training_id }}</td>
                <td data-label="Title">{{ $pending_training->training_title }}</td>
                <td data-label="Duration">{{ $pending_training->number_of_hours }} hours</td>
                <td data-label="Date of Conduct">{{ $pending_training->start_of_conduct.' - '. $pending_training->end_of_conduct }}</td>         
                <td data-label="Status">
                    @if ($pending_training->status == 0)
                        <span class="bg-warning">Pending</span>
                    @else
                        <span class="bg-danger">Rejected</span>
                    @endif
                </td>
                <td data-label="Action" class="d-block py-2">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-pending-training{{ $pending_training->id }}"><i class="bi bi-eye"></i></button>
                    @if ($pending_training->status == 0)
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-pending-training{{ $pending_training->id }}"><i class="bi bi-pencil-square"></i></button>
                    @endif
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_training_modal{{ $pending_training->id }}"><i class="bi bi-trash"></i></button>
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
                                <img src="{{ asset('storage/certificates/'.$pending_training->cop) }}" class="profile-pic mb-2" style="cursor: pointer" id="img-sizable">
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
                      <span class="fw-bold">Date Started</span>
                      <input class="p-2 mb-2 w-100" name="start_of_conduct" value="{{ $pending_training->start_of_conduct }}" disabled>
                      <span class="fw-bold">Date Ended</span> 
                      <input class="p-2 mb-2 w-100" name="end_of_conduct" value="{{ $pending_training->end_of_conduct }}" disabled>
                      <span class="fw-bold">Number of Hours</span> 
                      <input class="p-2 mb-2 w-100" name="number_of_hours" value="{{ $pending_training->number_of_hours }}" disabled>
                    </div>
                    <div class="col-md-6">
                      <span class="fw-bold">Type of LD</span>
                      <input class="p-2 mb-2 w-100" name="type_of_ld" value="{{ $pending_training->type_of_ld }}" disabled>
                      <span class="fw-bold">Source of Budget</span>
                      <input class="p-2 mb-2 w-100" name="source_of_budget" value="{{ $pending_training->source_of_budget }}" disabled>
                      <span class="fw-bold">Conducted By</span>
                      <input class="p-2 mb-2 w-100" name="conducted_by" value="{{ $pending_training->conducted_by }}" disabled>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <span class="fw-bold">Service Provider</span> 
                      <input class="p-2 mb-2 w-100" name="service_provider" value="{{ $pending_training->service_provider }}" disabled>
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

<!-- Edit Pending Training-->
<form action="{{ route('UpdatePendingTraining', $pending_training->id) }}" method="POST" id="update_pending_training" data-id="{{ $pending_training->id }}">
@csrf
@method("PUT")
<div class="modal fade" id="edit-pending-training{{ $pending_training->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <img src="{{ asset('storage/certificates/'.$pending_training->cop) }}" class="profile-pic mb-2" style="cursor: pointer" id="img-sizable">
                            <div class="icon-holder">
                                <div class="upload-icon"><i class="bi bi-cloud-arrow-up-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2">Certificate of Participation</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                @if (auth()->user()->role == 'admin')
                    <div class="form-group">
                        <span class="fw-bold">Training ID</span>
                        <input type="text" class="p-2 mb-2 w-100" name="training_id" value="{{ $pending_training->training_id }}" placeholder="Training ID">
                    </div>
                    @endif
                <div class="form-group">
                    <span class="fw-bold">Title</span>
                    <br>
                    <input type="text" name="training_title" value="{{ $pending_training->training_title }}" class="p-2 mb-2 w-100" placeholder="Enter Here">
                    <div class="text-danger message error-text training_title_error"></div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <span class="fw-bold">Date Started</span>
                    <br>
                    <input type="date" min="1900-01-01"  name="start_of_conduct" value="{{ $pending_training->start_of_conduct }}" class="p-2 mb-2 w-100" id="start-date">
                    <div class="text-danger message error-text start_of_conduct_error"></div>
                    </div>
                    <div class="form-group">
                    <span class="fw-bold">Date Ended</span>
                    <br>
                    <input type="date" min="1900-01-01"  name="end_of_conduct" value="{{ $pending_training->end_of_conduct }}" class="p-2 mb-2 w-100" id="end-date">
                    <div class="text-danger message error-text end_of_conduct_error"></div>
                    </div>
                    <div class="form-group">
                    <span class="fw-bold">Number of Hours</span>
                    <br>
                    <input type="text" name="number_of_hours" value="{{ $pending_training->number_of_hours }}" class="p-2 mb-2 w-100" placeholder="(ex. 24)">
                    <div class="text-danger message error-text number_of_hours_error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-1">
                    <span class="fw-bold">Type of LD</span>
                    <br>
                        <select name="type_of_ld" id="" class="p-2 mb-2 w-100">
                        @if ($pending_training->type_of_ld)
                            <option disabled>Select</option>
                            <option selected value="{{ $pending_training->type_of_ld }}">{{ $pending_training->type_of_ld }}</option>
                            <option value="managerial">Managerial</option>
                            <option value="supervisory">Supervisory</option>
                            <option value="technical">Technical</option>
                        @else
                            <option selected disabled>Select</option>
                            <option value="managerial">Managerial</option>
                            <option value="supervisory">Supervisory</option>
                            <option value="technical">Technical</option>
                        @endif
                        </select>
                        <div class="text-danger message error-text type_of_ld_error"></div>
                    </div>
                    <div class="form-goup mb-1">
                    <span class="fw-bold">Source of Budget</span>
                    <br>
                    <select name="source_of_budget" id="" class="p-2 mb-2 w-100 source_of_budget">
                        @if ($pending_training->source_of_budget)
                        <option disabled>Select</option>
                        <option selected value="{{ $pending_training->source_of_budget }}">{{ strtoupper($pending_training->source_of_budget) }}</option>
                        <option value="school">School</option>
                        <option value="division">Division</option>
                        <option value="mooe">MOOE</option>
                        <option value="hrd-fund">HRD Fund</option>
                        <option>Others</option>
                        @else
                        <option selected disabled>Select</option>
                        <option value="school">School</option>
                        <option value="division">Division</option>
                        <option value="mooe">MOOE</option>
                        <option value="hrd-fund">HRD Fund</option>
                        <option>Others</option>
                        @endif
                    </select> 
                    <input type="text" name="source_of_budget" class="p-2 mb-2 w-100 other_source d-none" placeholder="Enter Here" disabled>
                    <div class="text-danger message error-text source_of_budget_error"></div>
                    </div>
                    <div class="form-group">
                    <span class="fw-bold">Conducted By</span>
                    <br>
                    <input type="text" name="conducted_by" value="{{ $pending_training->conducted_by }}" class="p-2 mb-2 w-100" placeholder="Enter Here">
                    <div class="text-danger message error-text conducted_by_error"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <span class="fw-bold">Service Provider</span>
                    <br>
                    <select name="service_provider" class="p-2 mb-2 w-100">
                    @if ($pending_training->service_provider)
                    <option disabled>Select</option>
                    <option selected value="{{ $pending_training->service_provider }}">{{ $pending_training->service_provider }}</option>
                    <option value="internal">Internal</option>
                    <option value="external">External</option>
                    @else
                    <option selected disabled>Select</option>
                    <option value="internal">Internal</option>
                    <option value="external">External</option>
                    @endif
                </select>
                <div class="text-danger message error-text service_provider_error"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-secondary pending_training_reset" id="{{ $pending_training->id }}" value="Cancel">
        <input type="submit" class="btn btn-success btn-accept" value="Save">
    </div>
    </div>
</div>
</div>
</form>

<div class="zoom-photo d-none">
    @if ($pending_training->cop)
    <img src="{{ asset('storage/certificates/'.$pending_training->cop) }}" id="zoomed-img">
    @else
    <img src="{{ asset('storage/images/avatar.png') }}"  id="zoomed-img">
    @endif
    <span class="close-icon"><i class="bi bi-x-circle"></i></span>  
  </div>

 <!--Change Profile form-->
 <form action="{{ route('updateCertificate', $pending_training->id) }}" method="POST" id="picture_change">
    @csrf
    @method('PUT')
    <input name="image" type="file" accept=".png, .jpg, .jpeg" class="d-none" id="image-upload">
    <input type="text" name="old_image" value="{{ $pending_training->cop }}" class="d-none">
    <input type="submit" id="picture_change_btn" class="d-none">
  </form>
@endforeach
</div>
