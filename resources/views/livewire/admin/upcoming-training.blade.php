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

    <div class="col-md-4 mb-2">
        <button type="button" class="create-training-btn fw-bold rounded border-0" id="create-training" data-bs-toggle="modal" data-bs-target="#create_training_modal"><i class="bi bi-plus-lg"></i></button>
    </div>
    @if (count($upcoming_trainings) > 0)
        @foreach ($upcoming_trainings as $training)
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
        </div>
        @endforeach
    @else
    <div class="col-md-4 p-2 d-flex justify-content-center align-items-center">
        <h4>No Upcoming Training Yet!</h4>
    </div>
    @endif

@foreach ($upcoming_trainings as $training)
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
    
<!--Create Training Modal-->
    <div wire:ignore.self class="modal fade" id="create_training_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Create Training</h5>
              <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="CreateTraining">
            @csrf
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="form-group mb-2 p-2">
                            <div class="notice"><strong>Note:</strong> Fill out all the details and provide necessary documents</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Training Title</label>
                                <input type="text" wire:model="training_title" class="p-2 mb-2 w-100" placeholder="Enter Here">
                                @error('training_title')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start-date">Start of Training</label>
                                <input type="date" min="{{ $today }}"  wire:model="start_of_conduct" class="p-2 mb-2 w-100" id="start-date">
                                @error('start_of_conduct')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end-date">End of Training</label>
                                <input type="date" min="{{ $today }}"  wire:model="end_of_conduct" class="p-2 mb-2 w-100" id="end-date">
                                @error('end_of_conduct')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Type of Service Provider</label>
                                <select wire:model.live="service_provider" class="p-2 mb-2 w-100">
                                    <option value="" disabled>Select</option>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                    <option value="Others">Others</option>
                                </select>
                                @if ($other_service_provider == true)
                                    <input type="text" wire:model="specific_service_provider" class="p-2 w-100" placeholder="Specify Here..">   
                                @endif
                                @error('service_provider')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No. of Participants</label>
                                <input type="number" min="1" wire:model="number_of_participants" class="p-2 w-100">
                                    @error('number_of_participants')
                                        <div class="text-danger message">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Type of Training</label>
                                <select wire:model.live="training_type" id="" class="p-2 mb-2 w-100">
                                    <option value="" disabled>Select</option>
                                    <option value="GAD">GAD</option>
                                    <option value="Others">Others</option>
                                </select>
                                @if ($other_training_type == true)
                                    <input type="text" wire:model="specific_training_type" class="p-2 w-100" placeholder="Specify Here..">   
                                @endif
                                @error('training_type')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label for="">Conducted By</label>
                                <select wire:model.live="conducted_by" id="" class="p-2 mb-2 w-100">
                                    <option value="" disabled>Select</option>
                                        <option value="SGOD">SGOD</option>
                                        <option value="CID">CID</option>
                                        <option value="OSDS">OSDS</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    @if ($other_conducted_by == true)
                                        <input type="text" wire:model="specific_conducted_by" class="p-2 w-100" placeholder="Specify Here..">   
                                    @endif
                                @error('conducted_by')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Type of Learning Development</label>
                                <select wire:model.live="type_of_ld" id="" class="p-2 mb-2 w-100">
                                    <option value="" disabled>Select</option>
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option >
                                    <option value="Others">Others</option>
                                </select>
                                @if ($other_type_of_ld == true)
                                    <input type="text" wire:model="specific_type_of_ld" class="p-2 w-100" placeholder="Specify Here..">   
                                @endif
                                @error('type_of_ld')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Source of Budget</label>
                                <select wire:model.live="source_of_budget" id="" class="p-2 mb-2 w-100">
                                    <option value="" disabled>Select</option>
                                    <option value="School - MOOE">School - MOOE</option>
                                    <option value="Division - MOOE">Division - MOOE</option>
                                    <option value="HRD Fund">HRD Fund</option>
                                    <option value="GAD Fund">GAD Fund</option>
                                    <option value="Others">Others</option>
                                </select>
                                @if ($other_source_of_budget == true)
                                    <input type="text" wire:model="specific_source_of_budget" class="p-2 w-100" placeholder="Specify Here..">   
                                @endif
                                @error('source_of_budget')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="budget">Responsible Unit</label>
                                <input type="text" wire:model="responsible_unit" class="p-2 w-100">
                                @error('responsible_unit')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Venue</label>
                                <input type="text" wire:model="venue" class="p-2 w-100">
                                    @error('venue')
                                        <div class="text-danger message">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Reference</label>
                                <input type="text" wire:model="reference" class="p-2 w-100">
                                    @error('reference') 
                                        <div class="text-danger message">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-2 p-2">
                            <button type="submit" class="w-100 p-2 rounded submit-training">Create Now</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </form>

    <script>
        window.addEventListener('hide_modal', function(){
            $('#create_training_modal .close-modal').click();
        });
    </script>
</div>
