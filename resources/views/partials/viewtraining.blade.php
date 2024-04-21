@foreach ($attended_trainings as $attended_training)
<!--Editing and Viewing Photo-->
<div class="zoom-photo d-none">
  @if ($attended_training->cop)
  <img src="{{ asset('storage/certificates/'.$attended_training->cop) }}" id="zoomed-img">
  @else
  <img src="{{ asset('assets/images/avatar.png') }}"  id="zoomed-img">
  @endif
  <span class="close-icon"><i class="bi bi-x-circle"></i></span>  
</div>

    <div class="modal fade" id="view-my-training{{ $attended_training->training_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <img src="{{ asset('storage/certificates/'.$attended_training->cop) }}" class="profile-pic photo mb-2" style="cursor: pointer; height: 90px; width: 90px;" id="img-sizable">
                          <div class="text-center mb-2">Certificate of Participation</div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="fw-bold">Title</span>
                      <div class="border bg-transparent p-2 mb-2">{{ $attended_training->training_title }}</div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                        <span class="fw-bold">Date Started</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->start_of_conduct }}</div>
                        <span class="fw-bold">Date Ended</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->end_of_conduct }}</div>
                        <span class="fw-bold">Number of Hours</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->number_of_hours }}</div>
                      </div>
                      <div class="col-md-6">
                        <span class="fw-bold">Type of LD</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->type_of_ld }}</div>
                        <span class="fw-bold">Source of Budget</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->source_of_budget }}</div>
                        <span class="fw-bold">Conducted By</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->conducted_by }}</div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="fw-bold">Service Provider</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $attended_training->service_provider }}</div>
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