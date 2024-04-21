@extends('admin.dashboard')

@section('page-title', 'GAD Need Assessment')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.gad-question')
    </div>
</div>
@endsection

