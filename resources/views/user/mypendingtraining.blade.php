@extends('user.dashboard')

@section('page-title', 'Pending Training')

@section('dashboard-content')

<div class="container">
    <div class="row">
        @livewire('user-pending-training')
    </div>
</div>
@endsection
