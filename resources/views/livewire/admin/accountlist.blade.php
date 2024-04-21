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
            <button class="add-user-btn rounded shadow m-1" data-bs-toggle="modal" data-bs-target="#add_user_modal">+</button>
            <button class="border-0 rounded shadow text-white m-1 p-2" data-bs-toggle="modal" data-bs-target="#generate-report-modal" style="background: #665cee"><i class="bi bi-file-earmark fs-3"></i></button>
        </div>
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="category">
                    <option value="">All</option>
                    @foreach ($category_values as $value)
                        <option value="{{ $value->category }}">{{ $value->category }}</option>
                    @endforeach
                </select>
                <select class="mx-1" wire:model.live="position">
                    <option value="">All</option>
                    @foreach ($filtered_position_values as $value)
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
                    <option value="4">Retired</option>
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
                <th>Category</th>
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
                            <td data-label="Category">{{ $employee->category }}</td>
                            <td data-label="Position">{{ $employee->position }}</td>
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
                                @case(4)
                                    <td data-label="Status"><div class="bg-primary">Retired</div></td>
                                @break
                                    
                            @endswitch
                            <td data-label="Action" class="d-block py-2">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#jobstatus_modal" wire:click="getData({{ $employee->employee_id }})"><i class="bi bi-gear"></i></button>
                                <a href="{{ route('viewuserprofile', $user_id) }}" class="btn btn-info"><i class="bi bi-eye"></i></a> 
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_admin_modal{{ $employee->employee_id }}"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        
                        @endforeach
                    @else
                        <tr>
                            <td data-label="Admins" colspan="8" class="text-center p-3">No Accounts</td>
                        </tr>
                    @endif
            </tbody>
        </table>
        <span class="fs-5">Total: </span>{{ count($employees) }}
    </div>

    
 <!-- Add User Modal-->
    <div wire:ignore.self class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                <div class="mb-2">
                    <span class="h5"><b>Add </b></span>
                    <span class="as mx-1">as</span>
                    <select class="px-2 mx-auto" wire:model.live="newcategory">
                        <option disabled value="">Category</option>
                        @foreach ($category_values as $value)
                            <option value="{{ $value->category }}">{{ $value->category }}</option>
                        @endforeach
                    </select>
                    <span class="mx-1">Position</span>
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

    <div wire:ignore.self class="modal fade" id="generate-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Generate Employee Report</h5>
                    <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="generateReport">
                <div class="modal-body p-4">
                    <div class="col-md-12 p-2 mb-1">
                        <div class="form-group text-center p-2 mb-2">
                            <span class="fs-5">Category: </span>
                            <select wire:model.change="report_category" class="p-2 w-100">
                                <option value="">All</option>
                                <option value="Teaching">Teaching</option>
                                <option value="Non-Teaching">Non-Teaching</option>
                                <option value="Teaching Related">Teaching Related</option>
                            </select>
                            @error('report_category')
                                <div class="text-danger message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group text-center p-2">
                            <span class="fs-5">Position: </span>
                            <select wire:model.change="report_position" class="p-2 w-100">
                                <option value="">All</option>
                                @foreach ($report_position_values as $report_position_value)
                                    <option value="{{ $report_position_value->position }}">{{ $report_position_value->position }}</option>
                                @endforeach
                            </select>
                            @error('report_position')
                                <div class="text-danger message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group text-center p-2">
                            <span class="fs-5">Sex: </span>
                            <select wire:model.change="report_sex" class="p-2 w-100">
                                <option value="">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('report_sex')
                                <div class="text-danger message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    @if (session()->has('found-report'))
                        <div class="col-md-12 px-3">
                            <div class="alert alert-success fade show alert-dismissable position-relative">
                                <strong>Found! </strong> {{ session()->get('found-report') }}
                                <a target="_blank" href="{{ route('printEmployeeList', ['report_category' => $report_category, 'report_position' => $report_position, 'report_sex' => $report_sex]) }}" class=" text-decoration-none p-2 rounded position-absolute" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></a>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('fail'))
                        <div class="col-md-12 px-3">
                            <div class="alert alert-danger fade show alert-dismissable position-relative">
                                <strong>No Data! </strong> {{ session()->get('fail') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="col-md-12 px-3 message">
                            <div class="alert alert-danger fade show alert-dismissable position-relative">
                                <strong>Error! </strong> {{ session()->get('error') }}
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

    <!-- Change User Job Status Modal-->
    <div wire:ignore.self class="modal fade" id="jobstatus_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Change Status</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="changeJobStatus">
                @csrf
                <div class="modal-body text-center">
                    <input type="text" wire:model="employee_id" class="mb-2 p-2 w-100" disabled>
                    <input type="text" wire:model="name" class="mb-2 p-2 w-100" disabled>
                    <select wire:model="user_job_status" class="p-2 w-100">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                        <option value="3">Resigned</option>
                        <option value="4">Retired</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal" wire:click="resetData">Close</button>
                    <button type="submit" class="btn btn-success">Change</button>
                </div>
            </form>
            </div>
          </div>
      </div>

    @include('partials.admin_modals')

    <script>
        window.addEventListener('hide_modal', function(){
            $('#add_user_modal .close-modal').click();
            $('#jobstatus_modal .close-modal').click();
        });
    </script>
</div>