@extends('admin.dashboard')

@section('page-title', 'GAD Need Assessment Result')

@section('dashboard-content')
<div class="container">
    @livewire('admin.gad-survey')
</div>
@endsection

