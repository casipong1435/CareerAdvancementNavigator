@foreach ($employees as $employee)

<!--Editing and Viewing Photo-->
<div class="zoom-photo--{{ $employee->id }} d-none" id="zoom-photo">
  @if ($employee->image)
  <img src="{{ asset('assets/images/'.$employee->image) }}" id="zoomed-img">
  @else
  <img src="{{ asset('assets/images/avatar.png') }}"  id="zoomed-img">
  @endif
  <span class="close-icon" data="{{ $employee->id }}"><i class="bi bi-x-circle"></i></span>  
</div>

<!-- View user modal-->
<div class="modal fade" id="view-admin-modal{{ $employee->employee_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/images/'.$employee->image) }}" data="{{ $employee->id }}" class="profile-pic photo mb-2" style="cursor: pointer; height: 90px; width: 90px;">
                        <div class="text-center mb-2">{{ ucfirst($employee->first_name)." ".ucfirst($employee->last_name) }}</div>
                    </div>
                    <div class="row">
                      <div class="form-group">
                        <span class="fw-bold">Employee ID</span>
                        <input type="text" class="p-2 mb-2 w-100" value="{{ $employee->employee_id }}" placeholder="Employee ID" disabled>
                      </div>
                      <div class="form-group">
                        <span class="fw-bold">Date of Birth</span>
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $employee->date_of_birth }}</div>
                      </div>
                      <div class="form-group">
                        <span class="fw-bold">Sex</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $employee->sex }}</div>
                      </div>
                      <div class="form-group">
                        <span class="fw-bold">Email</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $employee->email }}</div>
                      </div>
                      <div class="form-group">
                        <span class="fw-bold">Mobile</span> 
                        <div class="border bg-transparent p-2 mb-2 w-100">{{ $employee->mobile_number }}</div>
                      </div>
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


  <!-- Delete User Modal-->
  <div class="modal fade" id="delete_admin_modal{{ $employee->employee_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center p-4">
            <div class="text-danger warning-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="warning-text">Are you sure you want to delete this user?</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger btn-delete" id="{{$employee->employee_id}}">Confirm</button>
        </div>
      </div>
    </div>
  </div>

@endforeach