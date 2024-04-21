@extends('admin.dashboard')

@section('page-title', 'Attendance Information')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        <div class="py-2 d-flex justify-content-end">
            <div>Training ID: <strong>{{ $training_info->training_id }}</strong></div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="shadow rounded">
                <div class="p-1 text-center fw-bold border-bottom" style="background: #ffcc41;">{{ $training_info->training_title }}</div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Start of Conduct:</div>
                    <div class="fw-bold">{{ $training_info->start_of_conduct }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>End of Conduct:</div>
                    <div class="fw-bold">{{ $training_info->end_of_conduct }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>number of Hours:</div>
                    <div class="fw-bold">{{ $training_info->number_of_hours }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Learning Development:</div>
                    <div class="fw-bold">{{ $training_info->type_of_ld }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Source of Budget:</div>
                    <div class="fw-bold">{{ $training_info->source_of_budget }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Conducted By:</div>
                    <div class="fw-bold">{{ $training_info->conducted_by }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Service Provider:</div>
                    <div class="fw-bold">{{ $training_info->service_provider }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Number of Participants:</div>
                    <div class="fw-bold">{{ $training_info->number_of_participants }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Venue:</div>
                    <div class="fw-bold">{{ $training_info->venue }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Training Type:</div>
                    <div class="fw-bold">{{ $training_info->training_type }}</div>
                </div>
                <div class="d-flex justify-content-between flex-row p-2 mb-1">
                    <div>Reference:</div>
                    <div class="fw-bold">{{ $training_info->reference }}</div>
                </div>
            </div>
        </div>
        @livewire('view-attendance-info', ['training_id' => $training_info->training_id])
    </div>
</div>
@endsection

