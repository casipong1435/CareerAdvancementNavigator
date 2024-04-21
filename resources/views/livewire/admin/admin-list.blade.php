<div>
    @if (session()->has('success'))
        <div class="mb-1 px-1 message">
            <div class="alert alert-success alert-dismissible fade show message" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-1 px-1 message">
            <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                <strong>Error!</strong> {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <button class="add-user-btn  rounded shadow" data-bs-toggle="modal" data-bs-target="#add_admin_modal">+</button>
        </div>
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="position">
                    <option value="">All</option>
                    @foreach ($position_values as $value)
                        <option value="{{ $value->position }}">{{ $value->position }}</option>
                    @endforeach
                </select>
                <select class="mx-1" wire:model.live="sex" name="sex">
                    <option selected disabled>Sex</option>
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <select class="mx-1" wire:model.live="job_status" name="sex">
                    <option selected disabled>Status</option>
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                    <option value="3">Resigned</option>
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
            <th>Employee ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Sex</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if (count($employees) > 0)
                    @php
                        $i = 1;
                    @endphp

                    @foreach ($employees as $employee)

                    <?php
                        $user_id = [
                            'id' => Crypt::encrypt($employee->employee_id)
                        ]
                    ?>

                    <tr class="employee-data-{{ $employee->employee_id }}" id="table-data">
                        <td data-label="ID">{{ $i++ }}</td>
                        <td data-label="Employee ID">{{ $employee->employee_id }}</td>
                        <td data-label="Name">{{ ucwords($employee->first_name). ' '. ucfirst(substr($employee->middle_name, 0,1)). ' '.ucwords($employee->last_name) }}</td>
                        <td data-label="Position">{{ $employee->position}}</td>
                        <td data-label="Sex">{{ ucfirst($employee->sex) }}</td>
                        @switch($employee->job_status)
                                @case(1)
                                    <td data-label="Status"><div class="bg-success">Active</div></td>
                                    @break
                                @case(2)
                                    <td data-label="Status"><div class="bg-warning">Inactive</div></td>
                                    @break
                                @case(3)
                                    <td data-label="Status"><div class="bg-danger">Resigned</div></td>
                                    @break
                                @default
                                    
                            @endswitch
                        <td data-label="Action" class="d-block py-2">
                            @if (auth()->user()->employee_id != $employee->employee_id)
                                <a href="{{ route('viewuserprofile', $user_id) }}" class="btn btn-info"><i class="bi bi-eye"></i></a> 
                                @if (count($employees) > 1)
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_admin_modal{{ $employee->employee_id }}"><i class="bi bi-trash"></i></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    
                    @endforeach
                @else
                    <tr>
                        <td data-label="Admins" colspan="7" class="text-center p-3">No Admin Found</td>
                    </tr>
                @endif
        </tbody>
    </table>
        <span class="fs-5">Total: </span>{{ count($employees) }}
    </div>

 <!-- Add Admin Modal-->
 <div wire:ignore.self class="modal fade" id="add_admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit="addUser">
          @csrf
        <div class="modal-body text-center p-4">

              <div class="mb-2 text-start">
                  <span class="mx-1 fw-bold h4">Position</span>
                  <select class="px-2 mx-auto" wire:model="newposition">
                      <option disabled value="">Position</option>
                      @foreach ($position_values as $value)
                          <option value="{{ $value->position }}">{{ $value->position }}</option>
                      @endforeach
                  </select>
                  @error('newposition')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>

              <div class="text-danger message error-text position_error"></div>
              <div class="form-group">
                  <input type="text" wire:model="employee_id" class="p-2 mb-2 w-100" placeholder="Employee ID">
                  @error('employee_id')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="text" wire:model="first_name" class="p-2 mb-2 w-100" placeholder="First Name">
                  @error('first_name')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="text" wire:model="middle_name" class="p-2 mb-2 w-100" placeholder="Middle Name (Optional)">
                  @error('middle_name')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="text" wire:model="last_name" class="p-2 mb-2 w-100" placeholder="Last Name">
                  @error('last_name')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="date" wire:model="date_of_birth" class="p-2 mb-2 w-100" >
                  @error('date_of_birth')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="password" wire:model="password" class="p-2 mb-2 w-100" placeholder="Password">
                  @error('password')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <input type="password" wire:model="confirm_password" class="p-2 mb-2 w-100" placeholder="Confirm Password">
                  @error('confirm_password')
                      <div class="text-danger message">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group d-flex flex-row">
                  <span class="me-3">Sex: </span>
                  <div>
                      <span><input type="radio" class="me-1" wire:model="newsex" value="male" id="male"><label class="me-1" for="male">Male</label></span>
                      <span><input type="radio" class="me-1" wire:model="newsex" value="female" id="female"><label class="me-1" for="female">Female</label></span>
                  </div>
              </div>
              @error('newsex')
                  <div class="text-danger message">{{ $message }}</div>
              @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  @include('partials.admin_modals')

  <script>
      window.addEventListener('hide_modal', function(){
          $('#add_admin_modal .close-modal').click();
      });
  </script>

</div>
