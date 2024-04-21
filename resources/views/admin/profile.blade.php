@extends('admin.dashboard')

@section('page-title', 'My Profile')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.profile')
    </div>
</div>
            
@endsection