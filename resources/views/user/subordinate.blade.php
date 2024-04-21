@extends('user.dashboard')

@section('page-title', 'Subordinates')

@section('dashboard-content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        @livewire('subordinate-list')
    </div>
</div>
<script src="{{ asset('assets\js\administrator.js') }}"></script> 
<script src="{{ asset('assets\js\errorvalidation.js') }}"></script> 
@endsection