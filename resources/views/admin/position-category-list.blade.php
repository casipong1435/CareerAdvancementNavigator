@extends('admin.dashboard')

@section('page-title', 'Position Category Lists')

@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.position-category-list')
    </div>
</div>
@endsection

