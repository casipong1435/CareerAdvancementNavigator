@extends('admin.dashboard')

@section('page-title', 'Dashboard')

@section('dashboard-content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2 p-2">
            <div class="row">
                <div class="col-md-5 me-4 shadow my-2 p-4 welcome-container rounded">
                    <div class="h3 fw-bold text-white">Hello, {{ $profile->first_name }}!</div>
                    <div class="text-white">Welcome back to Career Advancement Navigator</div>
                </div>
                <div class="col-md-3 mx-2 my-2 shadow p-0  rounded d-flex flex-row">
                    <div class="p-4 bg-danger d-flex justify-content-center align-items-center">
                        <div class="text-white"><i class="bi bi-people-fill fs-1"></i></div>
                    </div>
                    <div class="p-4 d-flex justify-content-center align-items-center flex-column">
                        <div class="text-dark fw-bold fs-2">{{ $pending_user_count }}</div>
                        <div>Pending User</div>
                    </div>
                </div>
                <div class="col-md-3 mx-2 my-2 shadow p-0  rounded d-flex flex-row">
                    <div class="p-4 bg-danger d-flex justify-content-center align-items-center">
                        <div class="text-white"><i class="bi bi-hourglass-bottom fs-1"></i></div>
                    </div>
                    <div class="p-4 d-flex justify-content-center align-items-center flex-column">
                        <div class="text-dark fw-bold fs-2">{{ $pending_training_count }}</div>
                        <div>On Verification</div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12 mb-2 p-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 p-1 m-2">
                            <div class="col-md-12 m-2 d-flex flex-row shadow rounded">
                                <div class="p-4 bg-dark d-flex justify-content-center align-items-center">
                                    <div class="text-white"><i class="bi bi-gender-female fs-1"></i></div>
                                </div>
                                <div class="p-4 d-flex justify-content-center align-items-center flex-column">
                                    <div class="text-dark fw-bold fs-2">{{ $female_user_count }}</div>
                                    <div>Female User</div>
                                </div>
                            </div>
                            <div class="col-md-12 m-2 d-flex flex-row shadow rounded">
                                <div class="p-4 bg-dark d-flex justify-content-center align-items-center">
                                    <div class="text-white"><i class="bi bi-gender-male fs-1"></i></div>
                                </div>
                                <div class="p-4 d-flex justify-content-center align-items-center flex-column">
                                    <div class="text-dark fw-bold fs-2">{{ $male_user_count }}</div>
                                    <div>Male User</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-0 shadow rounded m-2">
                            <div class="text-center text-white p-2 total-users-head fw-bold"><i class="bi bi-people-fill me-2"></i>TOTAL</div>
                            <div class="py-4 d-flex justify-content-center align-items-center flex-column">
                                <div class="fw-bold" style="font-size: 70px">{{ $total_user_count }}</div>
                                <div class="h2">Users</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="col-md-12 shadow g-0">
                        <div class="form-group w-100" style="background: #3929cc">
                            <div class="p-1 text-center text-white fs-4">Training</div>
                        </div>
                        <div class="col-md-12 gx-0">
                            <div class="row g-0">
                                <div class="col-md-4 border">
                                    <div class="form-group w-100" style="background: #3f3f3f">
                                        <div class="text-center p-1 text-white">Upcoming</div>
                                    </div>
                                    <div class="form-group d-flex justify-content-center align-items-center py-4">
                                        <h3>{{ $upcoming_training }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 border">
                                    <div class="form-group w-100" style="background: #3f3f3f">
                                        <div class="text-center p-1 text-white">Ongoing</div>
                                    </div>
                                    <div class="form-group d-flex justify-content-center align-items-center py-4">
                                        <h3>{{ $ongoing_training }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 border">
                                    <div class="form-group w-100" style="background: #3f3f3f">
                                        <div class="text-center p-1 text-white">Finished</div>
                                    </div>
                                    <div class="form-group d-flex justify-content-center align-items-center py-4">
                                        <h3>{{ $finished_training }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 shadow g-0 mt-2">
                    <div class="form-group w-100" style="background: #501d8a">
                        <div class="p-1 text-center text-white fs-4">Employee Registered</div>
                    </div>
                    <div class="col-md-12 gx-0">
                        <div class="row g-0">
                            <div class="col-md-4 border">
                                <div class="form-group w-100" style="background: #5554c5">
                                    <div class="text-center p-1 text-white">Teaching</div>
                                </div>
                                <div class="col-md-12 g-0">
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Male</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_personnel->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Female</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Total</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_personnel->get('male', 0) + $teaching_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #3a6444">
                                                <div class="text-center p-1 text-white">Senior Citizen</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_senior->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_senior->get('male', 0) + $teaching_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #f3813f">
                                                <div class="text-center p-1 text-white">PWD</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_pwd->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_pwd->get('male', 0) + $teaching_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 border">
                                <div class="form-group w-100" style="background: #5554c5">
                                    <div class="text-center p-1 text-white">Non-Teaching</div>
                                </div>
                                <div class="col-md-12 g-0">
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Male</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_personnel->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Female</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Total</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_personnel->get('male', 0) + $non_teaching_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #3a6444">
                                                <div class="text-center p-1 text-white">Senior Citizen</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_senior->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_senior->get('male', 0) + $non_teaching_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #f3813f">
                                                <div class="text-center p-1 text-white">PWD</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_pwd->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $non_teaching_pwd->get('male', 0) + $non_teaching_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 border">
                                <div class="form-group w-100" style="background: #5554c5">
                                    <div class="text-center p-1 text-white">Teaching Related</div>
                                </div>
                                <div class="col-md-12 g-0">
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Male</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_personnel->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Female</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100" style="background: #3f3f3f">
                                                <div class="text-center p-1 text-white">Total</div>
                                            </div>
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_personnel->get('male', 0) + $teaching_related_personnel->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #3a6444">
                                                <div class="text-center p-1 text-white">Senior Citizen</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_senior->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_senior->get('male', 0) + $teaching_related_senior->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-12 border">
                                            <div class="form-group w-100" style="background: #f3813f">
                                                <div class="text-center p-1 text-white">PWD</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_pwd->get('male', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border">
                                            <div class="form-group w-100">
                                                <div class="text-center p-1 text-dark fs-2">{{ $teaching_related_pwd->get('male', 0) + $teaching_related_pwd->get('female', 0) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets\js\profileeffect.js') }}"></script>
@endsection