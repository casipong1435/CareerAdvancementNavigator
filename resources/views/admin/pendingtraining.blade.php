@extends('admin.dashboard')

@section('page-title', 'Pending Training')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('pending-training-list')
    </div>
</div>
@endsection
