@extends('user.dashboard')
@section('page-title', 'Upcoming Training')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row d-flex align-items-center">
        @if (count($ongoing_trainings) > 0)
            @foreach ($ongoing_trainings as $training)
            <?php
                $training_id = [
                    'id' => Crypt::encrypt($training->training_id)
                ]
            ?>
            <div class="col-md-4 mb-3">
                <a href="{{ route('viewupcomingtraining', $training_id) }}" class="text-decoration-none text-dark" target="_blank">
                    <div class="shadow">
                        <div class="fw-bold d-flex justify-content-between flex-row training-head">
                            <div class="px-1 text-white">{{ $training->training_id }}</div>
                        </div>
                        <div class="text-center p-1 fw-bold training-data">
                            <div class="px-2">{{ $training->training_title }}</div>
                        </div>
                        <div class="p-1" style="background: #ffffff">
                            <div class="px-2 mb-1">Start Date: {{ $training->start_of_conduct }}</div>
                            <div class="px-2 mb-1">End Date: {{ $training->end_of_conduct }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <h1 class="text-center">No Ongoing Training Yet!</h1>
        @endif
    </div>
</div>
@endsection