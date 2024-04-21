@extends('admin.dashboard')

@section('page-title', 'Accounts')

@section('dashboard-content')
<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="row">
                <div class="d-flex justify-content-end  p-2">
                    <a wire:navigate href="{{ route('pendingaccount') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'pendingaccount' ? 'active':'' }}">Pending</a>
                    <a wire:navigate href="{{ route('accountlist') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'accountlist' ? 'active':'' }}">Users</a>
                    <a wire:navigate href="{{ route('administrator') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'administrator' ? 'active':'' }}">Administrators</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="co-md-12 mb-2">
            @yield('account-content')
        </div>
    </div>
</div>
@endsection