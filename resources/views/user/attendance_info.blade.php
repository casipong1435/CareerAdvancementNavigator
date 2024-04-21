@extends('user.dashboard')

@section('page-title', 'Attendance Information')

@section('dashboard-content')

<div class="container">
    <div class="row">
        @livewire('user-attendance', ['training_id' => $id])
    </div>
</div>
@endsection

