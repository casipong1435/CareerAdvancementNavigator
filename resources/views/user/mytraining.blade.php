@extends('user.dashboard')

@section('page-title', 'My Training')

@section('dashboard-content')

<div class="container">
    <div class="row">
        @livewire('user-training-list')
    </div>
</div>
@endsection

