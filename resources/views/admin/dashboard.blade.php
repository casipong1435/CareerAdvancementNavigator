@extends('layouts.app')

@section('content')
<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-3 primary-text fs-4 fw-bold text-white text-uppercase border-bottom">
        PDP-CAN
    </div>

    <div class="list-group list-group-flush my-3">
        <div class="bg-transparent text-center fw-bold second-text pb-3">
            <span class="h6 text-white">{{ auth()->user()->category.' - '.auth()->user()->position }}</span>
        </div>
        <div class="bg-transparent text-center border-top border-bottom text-secondary p-1">
            <span>MAIN NAVIGATION</span>
        </div>
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'admin' ? 'current' : '' }}">
            <i class="bi bi-house me-2"></i>Home
        </a>
        <a href="{{ route('adminupcomingtraining') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'adminupcomingtraining' || Route::currentRouteName() == 'ongoingtraining' || Route::currentRouteName() == 'verifytraining' || Route::currentRouteName() == 'finishedtraining' || Route::currentRouteName() == 'viewattendanceinfo' || Route::currentRouteName() == 'viewtraininginfo' ? 'current' : '' }}">
            <i class="bi bi-bullseye me-2"></i>Training
        </a>
        <a href="{{ route('accountlist') }} " class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'pendingaccount' || Route::currentRouteName() == 'accountlist' || Route::currentRouteName() == 'administrator' || Route::currentRouteName() == 'viewuserprofile' ? 'current' : '' }}">
            <i class="bi bi-person-lines-fill me-2"></i>Accounts
        </a>
        <a href="{{ route('school') }}" class="list-group-item list-group-item-action second-text {{ 'admin/dashboard/school' == Request::path() ? 'current' : '' }}">
            <i class="bi bi-building-fill me-2"></i>School/Station Lists
        </a>
        <a href="{{ route('positioncategory') }}" class="list-group-item list-group-item-action second-text {{ 'admin/dashboard/positions' == Request::path() ? 'current' : '' }}">
            <i class="bi bi-arrow-up-circle-fill me-2"></i>Position Category
        </a>
        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'profile' ? 'current' : '' }}">
            <i class="bi bi-person-circle me-2"></i>Profile
        </a>
        <a href="{{ route('gadquestion') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'gadquestion' || Route::currentRouteName() == 'gadsurvey' ? 'current' : '' }}">
            <i class="bi bi-gender-trans me-2"></i>GAD Need Assessment
        </a>
        <form method="POST" action="{{ route('logout') }}" id="submit-logout">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action text-danger border-0"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
        </form>
    </div>
</div>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg py-2 px-4" id="navbar-top">
        <div class="d-flex align-items-center text-white">
            <i class="bi bi-list-ul primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">@yield('page-title')</h2>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-center align-items-center rounded">
                @yield('dashboard-content')
            </div>
        </div>
    </div>

    <div class="container-fluid py-2">
        <div class="text-center footer-text">
            <div><b>Copyright © 2023 </b><a href="#" class="footlink">Career Advancement Navigator</a> | All Rights Reserved</div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="{{ asset('assets\js\dashboardeffect.js') }}"></script>
