@extends('admin.dashboard')

@section('page-title', 'Training Participant')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        @livewire('admin.list-of-participant', ['training_id' => $training_id])
    </div>
</div>
@endsection
