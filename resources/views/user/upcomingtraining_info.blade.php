@extends('user.dashboard')

@section('page-title', 'Training Information')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('view-upcoming-training-info', ['training_id' => $training_id])
    </div>
</div>
@endsection

