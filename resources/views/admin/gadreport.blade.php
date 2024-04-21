@extends('admin.dashboard')

@section('page-title', 'GAD Report')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.gad-report')
    </div>
</div>
@endsection

