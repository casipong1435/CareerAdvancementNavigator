<div class="row">
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <button class="btn text-white" style="background: #ffcc41" data-bs-toggle="modal" data-bs-target="#add_school_modal">+</button>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 1</div>
        <div class="school-names" style="background: #fff6c3">
            @foreach ($district1 as $school1)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school1->id }}">
                <div class="mb-1">{{ $school1->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school1->id }}" wire:click="deleteSchool({{ $school1->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 2</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district2 as $school2)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school2->id }}">
                <div class="mb-1">{{ $school2->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school2->id }}" wire:click="deleteSchool({{ $school2->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 3</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district3 as $school3)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school3->id }}">
                <div class="mb-1">{{ $school3->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school3->id }}" wire:click="deleteSchool({{ $school3->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 4</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district4 as $school4)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school4->id }}">
                <div class="mb-1">{{ $school4->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school4->id }}" wire:click="deleteSchool({{ $school4->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 5</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district5 as $school5)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school5->id }}">
                <div class="mb-1">{{ $school5->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school5->id }}" wire:click="deleteSchool({{ $school5->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 6</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district6 as $school6)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school6->id }}">
                <div class="mb-1">{{ $school6->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school6->id }}" wire:click="deleteSchool({{ $school6->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 7</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district7 as $school7)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school7->id }}">
                <div class="mb-1">{{ $school7->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school7->id }}" wire:click="deleteSchool({{ $school7->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 8</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district8 as $school8)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school8->id }}">
                <div class="mb-1">{{ $school8->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school8->id }}" wire:click="deleteSchool({{ $school8->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 9</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district9 as $school9)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school9->id }}">
                <div class="mb-1">{{ $school9->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school9->id }}" wire:click="deleteSchool({{ $school9->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">District 10</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($district10 as $school10)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $school10->id }}">
                <div class="mb-1">{{ $school10->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $school10->id }}" wire:click="deleteSchool({{ $school10->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">Division Office</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($division as $division_)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $division_->id }}">
                <div class="mb-1">{{ $division_->school_name }}</div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $division_->id }}" wire:click="deleteSchool({{ $division_->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
<div class="row">
    <div class="py-2">
        <span class="fs-5">Total: </span>{{ count($school_data) }}
    </div>
</div>

<!-- Add School Modal-->
    <div wire:ignore.self class="modal fade" id="add_school_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Add New School</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="addSchool">
            @csrf
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="form-group mb-2">
                            <select wire:model="district" class="w-100 p-2">
                                <option selected disabled value="">District</option>
                                <option value="1" >1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="Division">Division</option>
                            </select >
                            @error('district')
                                <div class="text-danger m-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" wire:model="school_name" class="p-2 w-100" placeholder="Enter School Name..">
                            @error('school_name')
                                <div class="text-danger m-1">{{ $message }}</div>
                            @enderror
                        </div>

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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary close-modal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add Now</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        window.addEventListener('hide:modal', function(){
            $('#add_school_modal .close-modal').click();
        });
      </script>
</div>
