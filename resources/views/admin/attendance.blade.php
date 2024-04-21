@extends('admin.dashboard')

@section('page-title', 'Attendance')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('attendance-list')
    </div>
</div>
@endsection

