<div class="row">
    
    <div class="col-md-12 p-2">
        <div class="form-group text-center p-2 border-bottom">
            <div class="fs-3">Gender and Development Activities or Topics</div>
            <div class="fs-5 fw-light">(Select the topmost 3)</div>
        </div>
        @if (count($gad_activity) > 0)
            <form wire:submit="selectActivity">
                @foreach ($gad_activity as $activity)
                    <div class="form-group p-2">
                        <input type="checkbox" wire:model.live="selected_gad_activity" {{ $limitReach && !in_array($activity->id, $selected_gad_activity) || $state == 0  ? 'disabled':'' }} value="{{ $activity->id }}" class="p-2 me-2">{{ $activity->description }}
                    </div>
                @endforeach
            
                <div class="form-group border-top mt-2 p-2">
                    @if ($isSubmitted)
                        @if ($state == 0)
                            <button type="button" class="btn btn-primary w-100" wire:click.prevent="changeState({{ 1 }})">Change Choices</button>
                        @else
                            <button type="submit" class="btn btn-success w-100 mb-2">Save</button>
                            <button type="button" class="btn btn-secondary w-100" wire:click.prevent="changeState({{ 0 }})">Cancel</button>
                        @endif
                    @else
                        <button type="submit" class="btn btn-success w-100 mb-2">Submit</button>
                    @endif
                </div>
                @error('selected_gad_activity')
                        <div class="text-danger text-center message">Please select your desired 3 GAD Activity or Topic</div>
                @enderror
            </form>
        @else
            <div class="form-group p-2 text-center">
                No GAD Activity Assessment Added Yet!
            </div>
        @endif

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
