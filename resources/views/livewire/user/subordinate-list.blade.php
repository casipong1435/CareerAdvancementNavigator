<div>
    <div class="py-2 d-flex justify-content-between">
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy">
                    <option selected disabled>Sort</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="orderBy">
                    <option disabled>By</option>
                    <option value="">All</option>
                    <option value="users.employee_id">Employee ID</option>
                    <option value="first_name">Name</option>
                    @if (auth()->user()->position != 'psds')
                        <option value="district">District</option>
                    @endif
                    @if (auth()->user()->position != 'school-head')
                        <option value="school">School</option>
                    @endif
                </select>
                <select class="mx-1" wire:model.live="sex">
                    <option selected value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
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
        <th>District</th>
        <th>School</th>
        <th>Action</th>
    </thead>
    <tbody>
    @if (count($subuserdata) > 0)

    <?php
            $i = 1;
    ?>
        @foreach ($subuserdata as $subordinates)
            <?php
                $user_id = [
                    'id' => Crypt::encrypt($subordinates->employee_id)
                ]
            ?>  
            <tr>
                <td data-label="ID">{{ $i++ }}</td>
                <td data-label="Employee ID">{{ $subordinates->employee_id }}</td>
                <td data-label="Name">{{ ucfirst($subordinates->first_name). ' '. ucfirst($subordinates->middle_name). ' '.ucfirst($subordinates->last_name) }}</td>
                <td data-label="Position">{{ $subordinates->position }}</td>
                <td data-label="Sex">{{ $subordinates->sex }}</td>
                <td data-label="District">{{ $subordinates->district }}</td>                  
                <td data-label="School">{{ $subordinates->school }}</td>
                <td data-label="Action" class="d-block py-2">
                    <a href="{{ route('subordinateprofile', $user_id) }}" class="btn btn-info"><i class="bi bi-eye"></i></a> 
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" data-label="Pending Training" class="text-center p-2">No Subordinates in the System Yet!</td>
        </tr>
    @endif
    </tbody>
</table>
<span class="fs-5 mt-3">Total: </span>{{ count($subuserdata) }}
</div>
</div>
