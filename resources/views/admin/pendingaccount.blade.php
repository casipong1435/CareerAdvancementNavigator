@extends('admin.dashboard')

@section('page-title', 'Pending Accounts')

@section('dashboard-content')


<div class="container">
  <div class="row">
      @livewire('pending-account')
  </div>
</div>

<script src="{{ asset('assets\js\administrator.js') }}"></script> 
@endsection