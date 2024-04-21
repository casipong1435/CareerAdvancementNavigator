@extends('layouts.app')

@section('title', 'Login')
@section('content')

<div id="page-content-wrapper">
    
    @include('partials.navigation')

    <div class="container-fluid px-4">
        <div class="row g-3 my-4">
            <div class="container p-3 bg-white d-flex justify-content-center align-items-center">
                <div class="login-card shadow d-flex flex-column">
                    <div class="text-center py-3 primary-text fs-4 fw-bold text-white text-uppercase border-bottom rounded-top" style="background:#5461D4;" >
                        Login
                    </div>
                    <div class="bg-transparent p-2 text-center">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group mt-3 custom-textbox">
                                <span class="icon-user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                    </svg>
                                </span>
                                <input type="text" class="textbox w-100 p-2" placeholder="Employee ID" name="employee_id" require>
                            </div>
                            <div class="form-group mt-3 custom-textbox">
                                <span class="icon-user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                    </svg>
                                </span>
                                <input type="password" class="textbox w-100 p-2" placeholder="Password" name="password" require>
                            </div>
                            <div class="form-group mt-3 px-1 text-center">
                                <input type="submit" class="login-btn  w-100 p-2" value="Login">
                            </div>
                            <div class="form-group mt-3 text-center">
                                <p>Don't have an account?<a href="{{ route('register') }}" class="register"> Register</a></p>
                            </div>
                            <div class="form-group mt-3 text-center">
                                @if (session()->has('failed'))
                                <div class="alert alert-danger fade show message">
                                    <strong>Error! </strong><span>{{session()->get('failed')}}</span>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<script src="{{ asset('assets\js\messagefade.js') }}"></script>

@endsection