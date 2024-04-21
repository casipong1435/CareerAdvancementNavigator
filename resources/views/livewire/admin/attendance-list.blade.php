<div class="row">
    @if (count($trainings) > 0)

            @foreach ($trainings as $training)
                <div class="col-md-4 mb-2" id="school_">
                    <a href="{{ route('viewattendanceinfo', $training->training_id) }}" class="text-decoration-none text-dark" target="_blank">
                        <div class="shadow">
                            <div class="fw-bold d-flex justify-content-between flex-row" style="background: #ffcc41">
                                <div class="px-1">{{ $training->training_id }}</div>
                            </div>
                            <div class="text-center p-1 fw-bold" style="background: #fff09c">
                                <div class="px-2">{{ $training->training_title }}</div>
                            </div>
                            <div class="school-names p-1" style="background: #fff6c3">
                                <div class="px-2 mb-1">Start Date: {{ $training->start_of_conduct }}</div>
                                <div class="px-2 mb-1">End Date: {{ $training->end_of_conduct }}</div>
                            </div>
                            <div class="school-names p-1" style="background: #fff09c">
                                <div class="px-2 mb-1">Status: <span class="{{ $training->status == 1 ? 'text-success':'text-warning' }}">{{ $training->status == 1 ? 'Finished':'Ongoing' }}</span></div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
        <h1 class="text-center">No Training Yet!</h1>
        @endif

</div>
