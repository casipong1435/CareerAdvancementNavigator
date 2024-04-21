@extends('user.dashboard')

@section('page-title', 'My Attendance')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <!--<button type="button" class="qr-btn p-1 mb-3 " data-bs-toggle="modal" data-bs-target="#scan_training_modal">Scan QR</button>-->
    
    <div class="row">
        @if (count($attended_training) > 0)

            @foreach ($attended_training as $training)

            <?php
                $training_id = [
                    'id' => Crypt::encrypt($training->training_id)
                ]
            ?>
                <div class="col-md-4 mb-2" id="school_">
                    <a href="{{ route('viewuserattendance', $training_id) }}" class="text-decoration-none text-dark" target="_blank">
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
        <h1 class="text-center">No Attended Training!</h1>
        @endif
    </div>
</div>

<!--Modal for QR Scanning-->
<!--<div class="modal fade" id="scan_training_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="my-qr-reader" class="d-block mx-auto rounded overflow-hidden"></div>
                <div class="you-qr-result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets\js\qrscanner.js') }}"></script>-->
@endsection

