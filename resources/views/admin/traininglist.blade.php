@extends('admin.dashboard')

@section('page-title', 'Training List')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('training-list')
    </div>
</div>
@endsection

