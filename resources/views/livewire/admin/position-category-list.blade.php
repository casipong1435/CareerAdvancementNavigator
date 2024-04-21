<div class="row">
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <button class="btn text-white" style="background: #ffcc41" data-bs-toggle="modal" data-bs-target="#add_position">+</button>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">Teaching Grades</div>
        <div class="school-names" style="background: #fff6c3">
            @foreach ($teaching_category as $teaching)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $teaching->id }}">
                <div class="d-flex flex-row">
                    <div class="mb-1 me-2">{{ $teaching->position }}</div>
                    <span>({{ $teaching->salaryID }} - {{ $teaching->salary }})</span>
                </div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $teaching->id }}" wire:click="deletePosition({{ $teaching->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">Non-Teaching Grades</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($non_teaching_category as $non_teaching)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $non_teaching->id }}">
                <div class="d-flex flex-row">
                    <div class="mb-1 me-2">{{ $non_teaching->position }}</div>
                    <span>({{ $non_teaching->salaryID }} - {{ $non_teaching->salary }})</span>
                </div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $non_teaching->id }}" wire:click="deletePosition({{ $non_teaching->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="px-1 text-center fw-bold" style="background: #ffcc41">Teaching Related Grades</div>
        <div class="school-names p-1" style="background: #fff6c3">
            @foreach ($teaching_related_category as $teaching_related)
            <div class="d-flex justify-content-between flex-row p-1" id="school_{{ $teaching_related->id }}">
                <div class="d-flex flex-row">
                    <div class="mb-1 me-2">{{ $teaching_related->position }}</div>
                    <span>({{ $teaching_related->salaryID }} - {{ $teaching_related->salary }})</span>
                </div>
                <button type="button" class="mx-2 btn-delete-school border-0" wire:key="{{ $teaching_related->id }}" wire:click="deletePosition({{ $teaching_related->id }})"><i class="bi bi-x-square-fill text-danger"></i></button>
            </div>
            @endforeach
        </div>
    </div>

<!-- Add School Modal-->
    <div wire:ignore.self class="modal fade" id="add_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Add Position Title</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="addPosition">
            @csrf
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="form-group mb-2">
                            <select wire:model="category" class="w-100 p-2">
                                <option selected disabled value="">Category</option>
                                <option value="Teaching" >Teaching</option>
                                <option value="Non-Teaching">Non-Teaching</option>
                                <option value="Teaching Related">Teaching Related</option>
                            </select >
                            @error('category')
                                <div class="text-danger m-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" wire:model="position" class="p-2 w-100" placeholder="Enter Position Title..">
                            @error('position')
                                <div class="text-danger m-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" wire:model="salaryID" class="p-2 w-100" placeholder="Salary Grade..">
                            @error('salaryID')
                                <div class="text-danger m-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <input type="number" wire:model="salary" class="p-2 w-100" placeholder="Salary..">
                            @error('salary')
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
            $('#add_position .close-modal').click();
        });
      </script>
</div>
