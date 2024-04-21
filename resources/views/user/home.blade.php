@extends('user.dashboard')

@section('page-title', 'Dashboard')

@section('dashboard-content')
    <div class="container">
         <h3>Welcome back, {{ ucfirst($employee_data->first_name).'!' }}</h3>
        <div class="row">
            @livewire('user.home')
        </div>
    </div>
@endsection