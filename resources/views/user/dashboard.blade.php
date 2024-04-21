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
        @if (auth()->user()->job_status == 1)
            @if (auth()->user()->category == 'Non-Teaching')
                @if ($employee_data->district != null && $employee_data->years_in_service != null)
                    <a href="{{ route('user') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'user' ? 'current' : '' }}">
                        <i class="bi bi-house me-2"></i>Home
                    </a>
                    <a href="{{ route('myupcomingtraining') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'myupcomingtraining' || Route::currentRouteName() == 'myongoingtraining' || Route::currentRouteName() == 'myaddedtraining' || Route::currentRouteName() == 'myattendedtraining' || Route::currentRouteName() == 'viewuserattendance' ? 'current' : '' }}">
                        <i class="bi bi-bullseye me-2"></i>My Training
                    </a>
                
                    @if (auth()->user()->category == 'Teaching Related' && auth()->user()->position == 'PSDS' || auth()->user()->position == 'EPS' || auth()->user()->position == 'School Head' || auth()->user()->position == 'School Head' || auth()->user()->position == 'OSDS' || auth()->user()->position == 'SDS')
                        <a href="{{ route('upcomingtraining') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'upcomingtraining' ? 'current' : '' }}">
                            <i class="bi bi-chevron-double-up me-2"></i>Upcoming Training
                        </a>
                        
                        <a href="{{ route('subordinate') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'subordinate' || Route::currentRouteName() == 'subordinateprofile' ? 'current' : '' }}">
                            <i class="bi bi-people me-2"></i>My Subordinate
                        </a>
                    @endif
                    <a href="{{ route('UserProfile') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'UserProfile' ? 'current' : '' }}">
                        <i class="bi bi-person-circle me-2"></i>Profile
                    </a>
                    <a href="{{ route('gadsurveyquestion') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'gadsurveyquestion' ? 'current' : '' }}">
                        <i class="bi bi-gender-trans me-2"></i>GAD Need Assessment
                    </a>
                @endif
                
            @else
                @if ($employee_data->district != null && $employee_data->years_in_service != null && (count($added_subject_area) > 0) && auth()->user()->status != 'rejected')
                <a href="{{ route('user') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'user' ? 'current' : '' }}" >
                    <i class="bi bi-house me-2"></i>Home
                </a>
                <a href="{{ route('myupcomingtraining') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'myupcomingtraining' || Route::currentRouteName() == 'myongoingtraining' || Route::currentRouteName() == 'myaddedtraining' || Route::currentRouteName() == 'myattendedtraining' || Route::currentRouteName() == 'viewuserattendance' ? 'current' : '' }}">
                    <i class="bi bi-bullseye me-2"></i>My Training
                </a>
                
                    @if (auth()->user()->category == 'Teaching Related' && auth()->user()->position == 'PSDS' || auth()->user()->position == 'EPS' || auth()->user()->position == 'School Head' || auth()->user()->position == 'OSDS' || auth()->user()->position == 'SDS')
                        <a href="{{ route('upcomingtraining') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'upcomingtraining' ? 'current' : '' }}">
                            <i class="bi bi-chevron-double-up me-2"></i>Upcoming Training
                        </a>

                        <a href="{{ route('subordinate') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'subordinate' || Route::currentRouteName() == 'subordinateprofile' ? 'current' : '' }}">
                            <i class="bi bi-people me-2"></i>My Subordinate
                        </a>
                    @endif
                    <a href="{{ route('UserProfile') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'UserProfile' ? 'current' : '' }}">
                        <i class="bi bi-person-circle me-2"></i>Profile
                    </a>
                    <a href="{{ route('gadsurveyquestion') }}" class="list-group-item list-group-item-action second-text {{ Route::currentRouteName() == 'gadsurveyquestion' ? 'current' : '' }}">
                        <i class="bi bi-gender-trans me-2"></i>GAD Need Assessment
                    </a>
                @endif
            @endif
        @endif
        
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
                @switch(auth()->user()->status)
                    @case('official')
                        @switch(auth()->user()->job_status)
                            @case(1)
                                    @if (auth()->user()->category == 'Non-Teaching')
                                        @if ($employee_data->district != null && $employee_data->years_in_service != null)
                                            @yield('dashboard-content')
                                        @else
                                            @include('partials.setupprofile')
                                        @endif
                                        @else
                                        @if ($employee_data->district != null && $employee_data->years_in_service != null && (count($added_subject_area) > 0))
                                            @yield('dashboard-content')
                                        @else
                                            @include('partials.setupprofile')
                                        @endif
                                    @endif
                                @break
                            @case(2)
                                <div class="pendingtab d-flex justify-content-center align-items-center text-center h-100 w-100">
                                    <div class="fs-1">Your account is inactive. <br>Please contact the admin if you find any issue. Thank You!</div>
                                </div>
                                @break

                            @case(3)
                                <div class="pendingtab d-flex justify-content-center align-items-center text-center h-100 w-100">
                                    <div class="fs-1">Your'e account have been archived. <br>Please contact the admin if you find any issue. Thank You!</div>
                                </div>
                                @break
                            @default
                                
                        @endswitch
                    @break
                    @case('pending')
                        <div class="pendingtab d-flex justify-content-center align-items-center text-center h-100 w-100">
                            <div class="fs-1">Your account has not yet approved. <br>Please wait for the admin approval. Thank You!</div>
                        </div>
                    @break
                
                    @case('rejected')
                        <div class="pendingtab d-flex justify-content-center align-items-center text-center h-100 w-100">
                            <div class="fs-1">Your account have been rejected. <br>Please contact the admin for more queries. Thank You!</div>
                        </div>
                    @break  
                @endswitch
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
<script src="{{ asset('assets\js\errorvalidation.js') }}"></script>
