    <div wire:ignore.self class="modal fade" id="add_training_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Add Training</h5>
              <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="AddTraining">
            @csrf
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="form-group mb-2 p-2">
                            <div class="notice"><strong>Note:</strong> Fill out all the details and provide necessary documents</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Select Training</label>
                                <select class="p-2 w-100 mb-2" wire:model.change="training">
                                    <option selected value="" disabled>Select</option>
                                    @foreach ($official_training as $training)
                                        <option value="{{ $training->id }}">{{ $training->training_title.' ('.$training->start_of_conduct.' - '.$training->end_of_conduct.')' }}</option>
                                    @endforeach
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  border disabled p-2 mb-2">
                                <label for="">Certificate Of Participation</label>
                                <input type="file" wire:model="certificate_of_participation" class="p-2 w-100">
                                @error('certificate_of_participation')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (session()->has('exist'))
                                <div class="p-1 message">
                                    <div class="alert alert-warning alert-dismissible fade show message" role="alert">
                                        <strong>Error!</strong> {{ session()->get('exist') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Training Title</label>
                                <input type="text" wire:model="training_title" class="p-2 mb-2 w-100" placeholder="Enter Here" {{ $select_training == true ? 'disabled':'' }}>
                                @error('training_title')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start-date">Start of Training</label>
                                <input type="date" max="{{ $today }}"  wire:model="start_of_conduct" class="p-2 mb-2 w-100" id="start-date" {{ $select_training == true ? 'disabled':'' }}>
                                @error('start_of_conduct')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end-date">End of Training</label>
                                <input type="date" max="{{ $today }}"   wire:model="end_of_conduct" class="p-2 mb-2 w-100" id="end-date" {{ $select_training == true ? 'disabled':'' }}>
                                @error('end_of_conduct')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="">Conducted By</label>
                                <select wire:model="conducted_by" id="" class="conducted_by p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }}>
                                    <option value="" disabled>Select</option>
                                        <option value="SGOD">SGOD</option>
                                        <option value="CID">CID</option>
                                        <option value="OSDS">OSDS</option>
                                        <option>Others</option>
                                </select>
                                <input type="text" wire:model="other_conducted_by" class="p-2 conducted_by d-none" placeholder="Enter Here...">
                                @error('conducted_by')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end-date">No. of Participants</label>
                                <input type="number"  wire:model="number_of_participants" class="p-2 mb-2 w-100" id="end-date" {{ $select_training == true ? 'disabled':'' }} placeholder="(Optional)">
                            </div>
                            <div class="form-group">
                                <label for="">Training type</label>
                                <select wire:model="training_type" class="training_type p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }}>
                                    <option value="" disabled>Select</option>
                                    <option value="GAD">GAD</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text"  wire:model="specific_training_type" class="training_type p-2 mb-2 w-100 d-none" {{ $select_training == true ? 'disabled':'' }} placeholder="Specify Here (Optional)">
                                @error('training_type')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Type of Learning Development</label>
                                <select wire:model="type_of_ld" id="" class="type_of_ld p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }}>
                                    <option value="" disabled>Select</option>
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option>
                                    <option>Others</option>
                                </select>
                                <input type="text" wire:model="other_type_of_ld" class="p-2 type_of_ld d-none" placeholder="Enter Here...">
                                @error('type_of_ld')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Source of Budget</label>
                                <select wire:model="source_of_budget" id="" class="source_of_budget p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }}>
                                    <option value="" disabled>Select</option>
                                    <option value="School - MOOE">School - MOOE</option>
                                    <option value="Division - MOOE">Division - MOOE</option>
                                    <option value="HRD Fund">HRD Fund</option>
                                    <option>Others</option>
                                </select>
                                <input type="text" wire:model="other_source_of_budget" class="p-2 source_of_budget d-none" placeholder="Enter Here...">
                                @error('source_of_budget')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Type of Service Provider</label>
                                <select wire:model="service_provider" class="service_provider p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }}>
                                    <option value="" disabled>Select</option>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                    <option>Others</option>
                                </select>
                                <input type="text" wire:model="other_service_provider" class="p-2 service_provider d-none" placeholder="Enter Here...">
                                @error('service_provider')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Responsible Unit</label>
                                <input type="text" wire:model="responsible_unit" class="p-2 mb-2 w-100" {{ $select_training == true ? 'disabled':'' }} placeholder="(Optional)">
                                @error('responsible_unit')
                                    <div class="text-danger message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end-date">Venue</label>
                                <input type="text"  wire:model="venue" class="p-2 mb-2 w-100" id="end-date" {{ $select_training == true ? 'disabled':'' }} placeholder="(Optional)">
                            </div>
                            <div class="form-group">
                                <label for="end-date">Reference</label>
                                <input type="text"  wire:model="reference" class="p-2 mb-2 w-100" id="end-date" {{ $select_training == true ? 'disabled':'' }} placeholder="(Optional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-2 p-2">
                            <button type="submit" class="w-100 p-2 rounded submit-training">
                                <div wire:loading wire:target="AddTraining">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <span class="visually-hidden">Loading...</span>
                                  </div>
                                Add Now
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        window.addEventListener('hide_modal', function(){
            $('#add_training_modal .close-modal').click();
        });
    </script>
