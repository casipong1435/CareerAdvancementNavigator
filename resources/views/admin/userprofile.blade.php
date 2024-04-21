@extends('admin.dashboard')
@section('page-title', 'User Profile')
@section('dashboard-content')
<div class="container">
    <div class="row">
        @livewire('admin.view-user-profile', ['employee_id' => $decrypted_employee_id])
    </div>
</div>
@endsection