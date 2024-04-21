@extends('admin.dashboard')
@section('page-title', 'Create Training')
@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row d-flex align-items-center">
        @livewire('ongoing-training')
    </div>
</div>
@endsection

