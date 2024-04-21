@extends('user.dashboard')

@section('page-title', 'GAD Need Assessment Survey')

@section('dashboard-content')

<div class="container">
    <div class="row">
        @livewire('user.gad-survey-question')
    </div>
</div>
@endsection
