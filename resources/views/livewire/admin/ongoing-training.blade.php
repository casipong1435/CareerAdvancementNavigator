<div class="row">
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

    @if (count($ongoing_trainings) > 0)
        @foreach ($ongoing_trainings as $training)
            <?php
                $training_id = [
                    'id' => Crypt::encrypt($training->training_id)
                ]
            ?>
        <div class="col-md-4 mb-3">
                <div class="shadow delete-ongoin-training">
                    <div class="fw-bold d-flex justify-content-between flex-row training-head">
                        <div class="px-1 text-white">{{ $training->training_id }}</div>
                        <button type="button" class="btn-delete-attendance border-0" onclick="confirm('Note: This will delete the training data and its associated data. Confirm if you want to proceed.') || event.stopImmediatePropagation()" wire:click="deleteID({{ $training->training_id }})" data-bs-toggle="modal" data-bs-target="#delete_training_modal{{ $training->training_id }}"><i class="bi bi-x-lg"></i></button>
                    </div>
            <a href="{{ route('viewtraininginfo', $training_id) }}" target="_blank" class="text-decoration-none text-dark">
                    <div class="text-center p-1 fw-bold training-data">
                        <div class="px-2">{{ $training->training_title }}</div>
                    </div>
                    <div class="p-1" style="background: #ffffff">
                        <div class="px-2 mb-1">Start Date: {{ $training->start_of_conduct }}</div>
                        <div class="px-2 mb-1">End Date: {{ $training->end_of_conduct }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('viewattendanceinfo', $training->training_id) }}" class="text-decoration-none" target="_blank">
                <div class="form-group w-100 p-2 text-center text-white" style="background: #6d6be9">
                    <div>Attendance</div>
                </div>
            </a>
        </div>
        @endforeach
    @else
    <div class="col-md-12 p-2 d-flex justify-content-center align-items-center">
        <h4>No Ongoing Training Yet!</h4>
    </div>
    @endif

@foreach ($ongoing_trainings as $training)
    <!-- Delete Training Modal-->
<div class="modal fade" id="delete_training_modal{{ $training->training_id }}" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Delete Training</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center p-4">
            <div class="text-danger warning-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="warning-text">Are you sure you want to delete this training?</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal" wire:click.prevent="deleteOngoinTraining({{ $training->training_id }})">Confirm</button>
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>
