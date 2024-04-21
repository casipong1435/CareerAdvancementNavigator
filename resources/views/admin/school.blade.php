@extends('admin.dashboard')

@section('page-title', 'School Lists')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.school-list')
    </div>
</div>
@endsection

