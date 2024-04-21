@extends('admin.dashboard')

@section('page-title', 'Account List')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        @livewire('accountlist')
    </div>
</div>

@endsection

