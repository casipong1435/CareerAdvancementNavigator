<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row g-0 d-flex justify-content-around">
                <div class="col-lg-3 mx-1 add-action d-flex justify-content-center align-items-center my-2">
                    <a href="{{ route('myaddedtraining') }}" class="text-decoration-none">
                        <div class="d-flex justify-content-center align-items-center flex-column text-white">
                            <div class="add-action-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                            <div class="action-title text-white mt-2 text-center">Add Training</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 mx-1 pending-action d-flex justify-content-center align-items-center my-2">
                    <a href="{{ route('myaddedtraining') }}" class="text-decoration-none">
                        <div class=" d-flex justify-content-center align-items-center flex-column text-white">
                            <div class="pending-count">{{ $count_pending_training }}</div>
                            <div class="pending-action-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div class="action-title text-white mt-2 text-center">Pending Training</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-5 mx-1 training-action my-2">
                    <a href="{{ route('myupcomingtraining') }}" class="text-decoration-none">
                        <div class=" d-flex justify-content-center align-items-center text-white">
                            <div class="home-training-count mx-4">{{ $count_attended_training }}</div>
                            <div class="home-training-text mx-4">Training Completed</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-2 g-0">
        <div class="col-md-12 mt-4 shadow">
            @if ($ongoing_training)
                <div class="row mb-2">
                    <a href="{{ route('myongoingtraining') }}" class="text-decoration-none">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between p-2" style="background: #655dd1">
                                <div class="text-white fs-5 fw-bold">{{ $ongoing_training->start_of_conduct < $today ? 'Ongoing':'Upcoming' }} Training</div>
                                <div class="text-white fs-5">{{ $ongoing_training->training_id }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Training Title</div>
                                <div class="text-dark">{{ $ongoing_training->training_title }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Start Date</div>
                                <div class="text-dark">{{ $ongoing_training->start_of_conduct }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">End Date</div>
                                <div class="text-dark">{{ $ongoing_training->end_of_conduct }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Number of Hours</div>
                                <div class="text-dark">{{ $ongoing_training->number_of_hours }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Condcuted By</div>
                                <div class="text-dark">{{ $ongoing_training->conducted_by }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Responsible Unit</div>
                                <div class="text-dark">{{ $ongoing_training->responsible_unit }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Number of Partcipants</div>
                                <div class="text-dark">{{ $ongoing_training->number_of_participants }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Venue</div>
                                <div class="text-dark">{{ $ongoing_training->venue }}</div>
                            </div>
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <div class="text-dark fw-bold">Reference</div>
                                <div class="text-dark">{{ $ongoing_training->reference }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="p-2">
                    <h3 class="text-center">No Upcoming Training!</h3>
                </div>
            @endif
        </div>
    </div>
    
</div>