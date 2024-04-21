@extends('admin.dashboard')

@section('page-title', 'Training')

@section('dashboard-content')
<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="row">
                <div class="d-flex justify-content-end  p-2">
                    <a wire:navigate href="{{ route('adminupcomingtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'adminupcomingtraining' ? 'active':'' }}">Upcoming</a>
                    <a wire:navigate href="{{ route('ongoingtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'ongoingtraining' ? 'active':'' }}">Ongoing</a>
                    <a wire:navigate href="{{ route('verifytraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'verifytraining' ? 'active':'' }}">On Verification</a>
                    <a wire:navigate href="{{ route('finishedtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'finishedtraining' ? 'active':'' }}">Conducted</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="co-md-12 mb-2">
            @yield('training-content')
        </div>
    </div>
</div>
@endsection