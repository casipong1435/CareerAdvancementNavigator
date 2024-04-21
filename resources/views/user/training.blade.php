@extends('user.dashboard')

@section('page-title', 'My Training')

@section('dashboard-content')
<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="row">
                <div class="d-flex justify-content-end  p-2">
                    <a href="{{ route('myupcomingtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'myupcomingtraining' ? 'active':'' }}">Upcoming</a>
                    <a href="{{ route('myongoingtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'myongoingtraining' ? 'active':'' }}">Ongoing</a>
                    <a href="{{ route('myaddedtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'myaddedtraining' ? 'active':'' }}">Added</a>
                    <a href="{{ route('myattendedtraining') }}" class="text-decoration-none px-2 training-link {{ Route::currentRouteName() == 'myattendedtraining' ? 'active':'' }}">Completed</a>
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