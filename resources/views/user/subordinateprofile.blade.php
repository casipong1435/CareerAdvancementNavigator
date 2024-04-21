@extends('user.dashboard')

@section('page-title', 'Subordinate')

@section('dashboard-content')

<div class="container">
    <div class="row">
        <div class="toggle-container d-flex justify-content-between">
            <div class="button-holder d-flex flex-row">
                <button class="profile-edit-button px-3 py-1 rounded" onclick="history.back()" type="button">
                    <i class="bi bi-arrow-left"></i>
                </button>
            </div>
            <div class="link-holder d-flex flex-row">
                <a href="#" class="personal-info current">Personal Information</a>
            </div>
        </div>

        <hr>
    
        <div class="main-profile-tab">

            <!--Profile Information-->
            <div class="container profile-container" id="profile-information">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="img-holder">
                                @if ($userdata->image) 
                                <img src="{{ asset('assets/images/'.$userdata->image) }}" class="profile-pic">
                                @else
                                <img src="{{ asset('assets/images/avatar.png') }}" class="profile-pic">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group mb-3">
                            <input type="text" value="{{ ucfirst($userdata->first_name) }}" class="w-100 p-2" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ ucfirst($userdata->last_name) }}" class="w-100 p-2" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group mb-3">
                            <input type="text" value="{{ ucfirst($userdata->middle_name) }}" placeholder="Middle Name (Optional)" class="w-100 p-2" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Position" value="{{ ucfirst($userdata->category) }}" class="w-100 p-2" disabled>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Position Title" value="{{ ucfirst($userdata->position) }}" class="w-100 p-2" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Date Started in DepEd</label>
                                    <input type="date" value="{{ $userdata->date_started_in_deped }}" class=" w-100 p-2" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Years in Service</label>
                                    <input type="text" value="{{ ucfirst($userdata->years_in_service) }}" class="w-100 p-2" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ strtoupper($userdata->salary) }}" placeholder="Current Salary (Monthly)" class=" w-100 p-2" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ $userdata->mobile_number }}" placeholder="Mobile Number" class=" w-100 p-2" disabled>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label for="">Date of Birth</label>
                                    <input type="text" value="{{ $userdata->date_of_birth }}" class="w-100 p-2" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="">Sex</label>
                                    <input type="text" value="{{ ucfirst($userdata->sex) }}" class="w-100 p-2" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="">Age</label>
                                    <div class="d-flex">
                                        <input type="text" value="{{$userdata->age}}" disabled placeholder="Age" class="w-100 p-2 mx-1">
                                        <input type="text" value="{{$userdata->age >= 60 ? 'Senior Citizen':'Not Senior Citizen'}}" disabled class="w-100 p-2 mx-1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">PWD</label>
                                    <input type="text" value="{{ $userdata->pwd }}" placeholder="Not Disabled" class="w-100 p-2" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ $userdata->email }}" placeholder="Email Address" class=" w-100 p-2" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ 'District '.$userdata->district }}" class=" w-100 p-2" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ 'District '.$userdata->school }}" class=" w-100 p-2" disabled>
                        </div>
                    </div>
                </div>

                <div class="row p-3">
                    <hr>
                </div>

                <!--Subject Area-->
                @if (auth()->user()->position != 'non-teaching')
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Subject Area</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            <div class="col-md-12" id="subject-div">
                                @if (count($user_subject_area) > 0)
                                    @foreach ($user_subject_area as $subject)
                                        <input type="text" class="p-2 m-2" value="{{ ucfirst($subject->description).' ('.$subject->from.' - '.$subject->to.')' }} " disabled>
                                    @endforeach
                                @else
                                <div class="form-group text-center">
                                <span>No Subject Area Added Yet.</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Career Services Area-->
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Career Services</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            @if (count($user_career_service) > 0)
                                @foreach ($user_career_service as $career)
                                    <input type="text" class="p-2 m-2" value="{{ ucfirst($career->description).' ('.$career->from.' - '.$career->to.')' }} " disabled>
                                @endforeach
                            @else
                            <div class="form-group text-center">
                                <span>No Career Service Added Yet.</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!--Educational Attainment Area-->
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Educational Attainments</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            <div class="col-md-12 p-2 mb-2">
                                <div class="fw-bold p-2">Doctorate</div>
                                <div class="col-md-12 border p-2">
                                    @if (count($user_educational_attainment_doctoral) > 0)
                                        @foreach ($user_educational_attainment_doctoral as $doctoral)
                                            <input type="text" class="p-2 m-2" value="{{ ucfirst($doctoral->description).' ('.$doctoral->from.' - '.$doctoral->to.')' }} " disabled>
                                        @endforeach
                                    @else
                                        <div class="form-group text-center">
                                            <span>No Doctorate Attainment Added Yet.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 p-2 mb-2">
                                <div class="fw-bold p-2">Masteral</div>
                                <div class="col-md-12 border p-2">
                                    @if (count($user_educational_attainment_masteral) > 0)
                                        @foreach ($user_educational_attainment_masteral as $masteral)
                                            <input type="text" class="p-2 m-2" value="{{ ucfirst($masteral->description).' ('.$masteral->from.' - '.$masteral->to.')' }} " disabled>
                                        @endforeach
                                    @else
                                        <div class="form-group text-center">
                                            <span>No Masteral Attainment Added Yet.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 p-2 mb-2">
                                <div class="fw-bold p-2">Others</div>
                                <div class="col-md-12 border p-2">
                                    @if (count($user_educational_attainment_others) > 0)
                                        @foreach ($user_educational_attainment_others as $others)
                                            <input type="text" class="p-2 m-2" value="{{ ucfirst($others->description).' ('.$others->from.' - '.$others->to.')' }} " disabled>
                                        @endforeach
                                    @else
                                        <div class="form-group text-center">
                                            <span>No Other Attainment Added Yet.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Grade Level Taught Area-->
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Grade Level Taught</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            @if (count($user_grade_level_taught) > 0)
                                @foreach ($user_grade_level_taught as $grade_level)
                                    <input type="text" class="p-2 m-2" value="{{ ucfirst($grade_level->description).' ('.$grade_level->from.' - '.$grade_level->to.')' }} " disabled>
                                @endforeach
                            @else
                            <div class="form-group text-center">
                                <span>No Grade Level Taught Added Yet.</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Training Attended Area-->
                <div class="row mt-3 px-3">
                    <div class="col-md-12">
                        <div class="border bg-transparent p-3 mb-2">
                            <label for="" class="mb-2">Training Attended: <strong>{{ count($attended_training) }}</strong></label>

                            @if (count($attended_training) > 0)
                                @foreach ($attended_training as $training)
                                    <div class="col-md-4 mb-3">
                                        <div class="shadow">
                                            <div class="fw-bold d-flex justify-content-between flex-row training-head">
                                                <div class="px-1 text-white">{{ $training->training_id }}</div>
                                            </div>
                                            <div class="text-center p-1 fw-bold training-data">
                                                <div class="px-2">{{ $training->training_title }}</div>
                                            </div>
                                            <div class="p-1" style="background: #ffffff">
                                                <div class="px-2 mb-1">Start Date: {{ $training->start_of_conduct }}</div>
                                                <div class="px-2 mb-1">End Date: {{ $training->end_of_conduct }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h3 class="text-center">This user have not added any attended training!</h3>
                            @endif
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<!-- Editing and Viewing Photo-->
<div class="zoom-photo d-none">
    @if ($userdata->image)
    <img src="{{ asset('assets/images/'.$userdata->image) }}" id="zoomed-img">
    @else
    <img src="{{ asset('assets/images/avatar.png') }}"  id="zoomed-img">
    @endif
    <span class="close-icon"><i class="bi bi-x-circle"></i></span>  
</div>

<script>
    $(document).ready(function(){
        
        $('.profile-pic').click(function(){
            $('.zoom-photo').removeClass('d-none');
            $('body').css('overflow', 'hidden');
        });

        $('.close-icon').click(function(){
            $('.zoom-photo').addClass('d-none');
            $('body').css('overflow', 'auto');
        });
    });
</script>

@endsection
