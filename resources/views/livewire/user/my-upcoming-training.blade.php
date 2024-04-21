<div>   
    <div class="py-2 d-flex justify-content-between">
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
        <th>Training Date</th>
        <th>Action</th>
    </thead>
    <tbody>
    @if (count($upcoming_training) > 0)
        @foreach ($upcoming_training as $training)
            <tr>
                <td data-label="ID">{{ $training->id }}</td>
                <td data-label="Training ID">{{ $training->training_id }}</td>
                <td data-label="Title">{{ $training->training_title }}</td>
                <td data-label="Duration">{{ $training->number_of_hours }} hours</td>
                <td data-label="Date of Conduct">{{ $training->start_of_conduct.' - '. $training->end_of_conduct }}</td>         
                <td data-label="Action" class="d-block py-2">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-my-training{{ $training->training_id }}"><i class="bi bi-eye"></i></button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6" class="text-center p-3">No Upcoming Training Yet.</td>
        </tr>
    @endif
    </tbody>
</table>
<span class="fs-5 t-3">Total: </span>{{ count($upcoming_training) }}
</div>

@foreach ($upcoming_training as $training)

    <div class="modal fade" id="view-my-training{{ $training->training_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="col-md-12">
                      <span class="fw-bold">Title</span>
                      <div class="border bg-transparent p-2 mb-2">{{ $training->training_title }}</div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <span class="fw-bold">Start of Training</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->start_of_conduct }}</div>
                        <span class="fw-bold">End of Training</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->end_of_conduct }}</div>
                        <span class="fw-bold">Number of Hours</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->number_of_hours }}</div>
                      </div>
                      <div class="col-md-6">
                        <span class="fw-bold">Type of LD</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->type_of_ld }}</div>
                        <span class="fw-bold">Source of Budget</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->source_of_budget }}</div>
                        <span class="fw-bold">Conducted By</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->conducted_by }}</div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="fw-bold">Service Provider</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $training->service_provider }}</div>
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
@endforeach
</div>
