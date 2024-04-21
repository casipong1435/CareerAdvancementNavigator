<div>
    <div class="py-2 d-flex justify-content-end">
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="pending_sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="pending_category">
                    <option value="">All</option>
                    @foreach ($pending_category_values as $value)
                        <option value="{{ $value->category }}">{{ $value->category }}</option>
                    @endforeach
                </select>
                <select class="mx-1" wire:model.live="pending_position">
                    <option value="">All</option>
                    @foreach ($pending_position_values as $value)
                        <option value="{{ $value->position }}">{{ $value->position }}</option>
                    @endforeach
                </select>
                <select class="mx-1" wire:model.live="pending_sex" name="sex">
                    <option selected disabled>Sex</option>
                    <option value="">Male & Female</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="pending_search_input" placeholder="Search...">
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
                <th>Birth Date</th>
                <th>Position</th>
                <th>Title</th>
                <th>Sex</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php $j = 1; ?>
                @if (count($employees) > 0)
                    @foreach ($employees as $pending_employee)
                        <?php
                            $user_id = [
                                'id' => Crypt::encrypt($pending_employee->employee_id)
                            ]
                        ?>
                    <tr class="employee-data-{{ $pending_employee->employee_id }}" id="table-data">
                        <td data-label="ID">{{ $j++ }}</td>
                        <td data-label="Employee ID">{{ $pending_employee->employee_id }}</td>
                        <td data-label="Name">{{ ucfirst($pending_employee->first_name). ' '. ucfirst($pending_employee->middle_name). ' '.ucfirst($pending_employee->last_name) }}</td>
                        <td data-label="Birth Date">{{ $pending_employee->date_of_birth }}</td>
                        <td data-label="Position">{{ $pending_employee->category }}</td>
                        <td data-label="Title">{{ $pending_employee->position }}</td>
                        <td data-label="Sex">{{ ucfirst($pending_employee->sex) }}</td>
                        <td data-label="Action" class="d-block py-2">
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view-admin-modal{{ $pending_employee->employee_id }}"><i class="bi bi-eye"></i></button> 
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accept_admin_modal" wire:key="accept{{ $pending_employee->employee_id }}" wire:click.prevent="clickModalID('{{ $pending_employee->employee_id }}')"><i class="bi bi bi-check-circle"></i></button>
                        <button class="btn btn-danger" wire:key="reject{{ $pending_employee->employee_id }}" wire:click.prevent="rejectUser('{{ $pending_employee->employee_id }}')">
                            <div wire:loading wire:target="rejectUser('{{ $pending_employee->employee_id }}')">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                                <path d="M15 8a6.973 6.973 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8ZM2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Z"/>
                            </svg>
                        </button>
                        </td>
                    </tr>     
                    @endforeach
                @else
                    <tr>
                        <td data-label="Accounts" colspan="8" class="text-center p-3">No Account Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="fs-5">Total: </span>{{ count($employees) }}
        
        <div class="row">
            <h3 class="mt-3">Rejected Accounts</h3>
            <div class="py-2 d-flex justify-content-end">
                <span class="filter d-flex flex-row d-inline-block">
                    <div class="mx-2 d-flex justify-content-center align-items-center">
                        <span class="filter">Filter: </span>
                        <select class="mx-1" wire:model.live="rejected_sortBy" name="sort">
                            <option selected disabled>Sort</option>
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                        <select class="mx-1" wire:model.live="rejected_category">
                            <option value="">All</option>
                            @foreach ($rejected_category_values as $value)
                                <option value="{{ $value->category }}">{{ $value->category }}</option>
                            @endforeach
                        </select>
                        <select class="mx-1" wire:model.live="rejected_position">
                            <option value="">All</option>
                            @foreach ($rejected_position_values as $value)
                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                            @endforeach
                        </select>
                        <select class="mx-1" wire:model.live="rejected_sex" name="sex">
                            <option selected disabled>Sex</option>
                            <option value="">Male & Female</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="search position-relative mx-2">
                        <input type="text" wire:model.live="rejected_search_input" placeholder="Search...">
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
                        <th>Birth Date</th>
                        <th>Position</th>
                        <th>Title</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if (count($rejected_accounts) > 0)
                            @foreach ($rejected_accounts as $rejected_account)
                                <?php
                                    $user_id = [
                                        'id' => Crypt::encrypt($rejected_account->employee_id)
                                    ]
                                ?>
                            <tr class="employee-data-{{ $rejected_account->employee_id }}" id="table-data">
                                <td data-label="ID">{{ $i++ }}</td>
                                <td data-label="Employee ID">{{ $rejected_account->employee_id }}</td>
                                <td data-label="Name">{{ ucfirst($rejected_account->first_name). ' '. ucfirst($rejected_account->middle_name). ' '.ucfirst($rejected_account->last_name) }}</td>
                                <td data-label="Birth Date">{{ $rejected_account->date_of_birth }}</td>
                                <td data-label="Position">{{ $rejected_account->category }}</td>
                                <td data-label="Title">{{ $rejected_account->position }}</td>
                                <td data-label="Sex">{{ ucfirst($rejected_account->sex) }}</td>
                                <td data-label="Action" class="d-block py-2">
                                    <button class="btn btn-secondary" wire:click.prevent="CancelRejection({{ $rejected_account->employee_id }})">Cancel</button>
                                    <button class="btn btn-danger" wire:confirm="Are you sure you want to delete this delete this account?" wire:click.prevent="DeleteAccount({{ $rejected_account->employee_id }})">Delete</button>  
                                </td>
                            </tr>     
                            @endforeach
                        @else
                            <tr>
                                <td data-label="Accounts" colspan="7" class="text-center p-3">No Account Yet</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <span class="fs-5">Total: </span>{{ count($rejected_accounts) }}
            </div>
        </div>
    </div>

  <!-- Accept User Modal-->
  <div wire:ignore.self wire:key="accept_admin_modal" class="modal fade" id="accept_admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Accept User</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body text-center p-4">
            <div class="text-success warning-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="warning-text">Are you sure you want to accept this user?</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" wire:click="acceptUser()">
                <div wire:loading wire:target="acceptUser">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                </div>
                Confirm
            </button>
        </div>
      </div>
    </div>
  </div>

  @include('partials.admin_modals')
<script>
    window.addEventListener('hide:modal', function(){
        $('#accept_admin_modal .close-modal').click();
    });
</script>
</div>
