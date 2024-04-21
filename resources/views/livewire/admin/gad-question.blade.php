<div class="row">
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

    <div class="col-md-12">
        <div class="form-group d-flex justify-content-between p-2">
            <div>
                <span class="fw-bold">Calendar Year:</span>
                <select wire:model.live="calendar_year" class="p-2">
                    @for ($year = $start_year; $year <= $end_year; $year++)
                    <option {{$year == $today ? 'selected':''}} value="{{$year}}">{{$year}}</option>
                    @endfor
                </select>
            </div>
            <div class="p-2">
                <a wire:navigate href="{{ route('gadquestion') }}" class="text-decoration-none px-1 training-link {{ Route::currentRouteName() == 'gadquestion' || session()->get('gadquestion') ? 'active':'' }}">GAD Assessment</a>
                <a wire:navigate href="{{ route('gadsurvey') }}" class="text-decoration-none px-1 training-link {{ Route::currentRouteName() == 'gadsurvey' ? 'active':'' }}">Result</a>
            </div>
        </div>

        <div class="col-md-12 mt-2">
            <div class="add-btn">
                @if ($calendar_year < $today)
                    <button class="btn btn-secondary mx-1 disabled">Assessment Ended</button>
                @else
                    <button class="add-user-btn mx-1" data-bs-toggle="modal" data-bs-target="#add_question_modal">+</button>
                    @if (!$isAssessment)
                        <button class="btn btn-success mx-1 " wire:confirm="Confirm to start the assessment" wire:click.prevent="startAssessment">Start Assessment</button>
                    @else
                        <button class="btn btn-danger mx-1 " wire:confirm="Did you wish to cancel the assessment" wire:click.prevent="cancelAssessment">Cancel Assessment</button>
                    @endif
                @endif
            </div>

            <table class="shadow rounded">
                <thead class=" border-bottom" style="background: #ffffff">
                    <tr>
                        <th>No.</th>
                        <th>Gender and Development Activity ({{$calendar_year}})</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="background: #ffffff">
                    @if (count($questions) > 0)
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($questions as $question)
                            <tr>
                                <td data-label="No." class="p-3">{{ $i++ }}</td>
                                <td data-label="Gender and Development Activity" class="text-start">{{ $question->description }}</td>
                                <td data-label="Action">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#question_modal" wire:click.prevent="QuestionID({{ $question->id }})"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger" wire:confirm="Are you sure you want to delete this activity?" wire:click="deleteQuestion({{ $question->id }})"><i class="bi bi-trash3"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No Choices Added</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="question_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Activity</h5>
                    <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="EditQuestion">
                    <div class="modal-body">
                        <div class="w-100 p-2 border disabled mb-2">{{ $id }}</div>
                        <input type="text" class="p-2 w-100" wire:model="description">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="add_question_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Activity</h5>
                    <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="AddQuestion">
                    <div class="modal-body">
                        <input type="text" class="p-2 w-100" wire:model="new_question" placeholder="Enter New Topic or Activity">
                        @error('new_question')
                            <div class="text-danger message">Field Required!</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('hide_modal', function(){
            $('#question_modal .close-modal').click();
            $('#add_question_modal .close-modal').click();
        });
    </script>

</div>
