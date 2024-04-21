
<div class="zoom-photo--{{$id}} d-none" id="zoom-photo">
  @if ($image)
  <img src="{{ storage_path('certificates/'.$image) }}" id="zoomed-img">
  @endif
  <span class="close-icon" data="{{ $id }}"><i class="bi bi-x-circle"></i></span>  
</div>

<div wire:ignore.self class="modal fade" id="view-pending-training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <img src="{{ storage_path('certificates/'.$image) }}" data="{{ $id }}" class="profile-pic photo mb-2" style="cursor: pointer; height: 90px; width: 90px;" id="img-sizable">
                      <div class="text-center mb-2">Certificate of Participation</div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Training ID</label>
                    <input type="text" wire:model="training_id" class="p-2 mb-2 w-100" placeholder="" disabled>
                  </div>
                  <div class="form-group">
                    <label for="">Training Title</label>
                    <input type="text" wire:model="training_title" class="p-2 mb-2 w-100" placeholder="" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="start-date">Start of Training</label>
                      <input type="date"  wire:model="start_of_conduct" class="p-2 mb-2 w-100" id="start-date" disabled>
                    </div>
                    <div class="form-group">
                      <label for="end-date">End of Training</label>
                      <input type="date"  wire:model="end_of_conduct" class="p-2 mb-2 w-100" id="end-date" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Type of Learning Development</label>
                      <input type="text"  wire:model="type_of_ld" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">No. of Participants</label>
                      <input type="text" wire:model="number_of_participants" placeholder="" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Venue</label>
                      <input type="text" wire:model="venue" placeholder="" class="p-2 mb-2 w-100" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Source of Budget</label>
                      <input type="text"  wire:model="source_of_budget" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-1">
                      <label for="">Conducted By</label>
                      <input type="text"  wire:model="conducted_by" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Type of Service Provider</label>
                      <input type="text"  wire:model="service_provider" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Responsible Unit</label>
                      <input type="text" wire:model="responsible_unit" placeholder="" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Training Type</label>
                      <input type="text" wire:model="training_type" placeholder="" class="p-2 mb-2 w-100" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Reference</label>
                      <input type="text" wire:model="reference" placeholder="" class="p-2 mb-2 w-100" disabled>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('hide:modal', function(){
      $('#view-pending-training .close-modal').click();
  });
</script>