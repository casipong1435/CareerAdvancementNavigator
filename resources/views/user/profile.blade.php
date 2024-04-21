@extends('user.dashboard')

@section('page-title', 'My Profile')

@section('dashboard-content')

<div class="container">
    <div class="row">
        @livewire('user.profile')
    </div>
</div>

@endsection