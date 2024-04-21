<div>
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <button class="border-0 p-2 rounded text-white report_button" data-bs-toggle="modal" data-bs-target="#generate-report-modal"><i class="bi bi-file-earmark fs-1"></i></button>
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
            @if (count($official_trainings) > 0)
                    @foreach ($official_trainings as $official_training)
                        <tr>
                            <td data-label="ID">{{ $official_training->id }}</td>
                            <td data-label="Training ID">{{ $official_training->training_id }}</td>
                            <td data-label="Title">{{ $official_training->training_title }}</td>
                            <td data-label="Duration">{{ $official_training->number_of_hours }} hours</td>
                            <td data-label="Date of Conduct">{{ $official_training->start_of_conduct.' - '. $official_training->end_of_conduct }}</td>         
                            <td data-label="Action" class="d-block py-2">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-training{{ $official_training->id }}"><i class="bi bi-eye"></i></button>
                            </td>
                        </tr>

                        <!-- Modal-->
                        <div class="modal fade" id="view-training{{ $official_training->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title text-white" id="exampleModalLabel">User Information</h5>
                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="fw-bold">Training ID</span>
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->training_id }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="fw-bold">Title</span>
                                                <div class="border bg-transparent p-2 mb-2">{{ $official_training->training_title }}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="col-md-6">
                                                <span class="fw-bold">Date Started</span>
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->start_of_conduct }}</div>
                                                <span class="fw-bold">Date Ended</span> 
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->end_of_conduct }}</div>
                                                <span class="fw-bold">Number of Hours</span> 
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->number_of_hours }}</div>
                                              </div>
                                              <div class="col-md-6">
                                                <span class="fw-bold">Type of LD</span>
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->type_of_ld }}</div>
                                                <span class="fw-bold">Source of Budget</span>
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->source_of_budget }}</div>
                                                <span class="fw-bold">Conducted By</span>
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->conducted_by }}</div>
                                              </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                                <span class="fw-bold">Service Provider</span> 
                                                <div class="border bg-transparent p-2 mb-2 w-100">{{ $official_training->service_provider }}</div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                    @endforeach
                @else
                    <tr>
                        <td data-label="Training" colspan="6" class="text-center">No Training Added Yet.</td>
                    </tr>
                @endif
        </tbody>
    </table>
    <span class="fs-5">Total: {{ count($official_trainings) }} </span>
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

                @if (session()->has('found'))
                    <div class="col-md-12 px-3">
                        <div class="alert alert-success fade show alert-dismissable position-relative">
                            <strong>Found! </strong> {{ session()->get('found') }}
                            <a target="_blank" href="{{ route('printAttendedTraining', ['from' => $from, 'to' => $to]) }}" class=" text-decoration-none p-2 rounded position-absolute" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></a>
                        </div>
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="col-md-12 px-3 message">
                        <div class="alert alert-danger fade show alert-dismissable position-relative">
                            <strong>No Data! </strong> {{ session()->get('found') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="col-md-12 px-3 message">
                        <div class="alert alert-danger fade show alert-dismissable position-relative">
                            <strong>No Data! </strong> {{ session()->get('found') }}
                            <button type="button" class="border-0 p-2 rounded position-absolute" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></button>
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
