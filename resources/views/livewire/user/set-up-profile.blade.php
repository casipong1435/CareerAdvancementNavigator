<div>
    @if (session()->has('success'))
            <div class="p-3 message">
                <div class="alert alert-success alert-dismissible fade show message" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-3 message">
                <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                    <strong>Error!</strong> {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="toggle-container d-flex justify-content-between">
            <div class="button-holder d-flex flex-row">
                <button type="button" class="profile-save-button px-3 py-1 mx-1 rounded" id="triggersubmit">SAVE</button>
            </div>
        </div>
        <div class="main-profile-tab mt-4">
                <!--Personal Information-->
                <div class="container profile-container" wire:ignore.self>
                    <form wire:key="updateProfile" wire:submit.prevent="updateProfile">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="img-holder">
                                    @if ($image) 
                                    <img src="{{ asset('assets/images/'.$image) }}" data="{{ $employee_id }}" class="profile-pic">
                                    @endif
                                    <div class="icon-holder">
                                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                                    </div>
                                </div>
                                <div class="notice"><span><b>Note: </b> Use Professional Picture</span></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <input type="text" wire:model="first_name" placeholder="First Name" class="w-100 p-2 " disabled>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" wire:model="last_name" placeholder="Last Name" class="w-100 p-2" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <input type="text" wire:model="middle_name" placeholder="Middle Name" class="w-100 p-2" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" wire:model="category" placeholder="Position" class="w-100 p-2 mb-2" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="position" placeholder="Position Title" class="w-100 p-2 mb-2" disabled>
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
                                        <input type="date" wire:model="date_started_in_deped" placeholder="Date Started in Deped" class="w-100 p-2 " >
                                        @error('date_started_in_deped')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Years in Service</label>
                                        <input type="text" wire:model="years_in_service" placeholder="Years in Service" class="w-100 p-2" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Salary Grade</label>
                                        <input type="text" wire:model="salary_grade" placeholder="Current Salary Grade" class="w-100 p-2" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Salary</label>
                                        <input type="text" wire:model="salary" placeholder="Current Salary" class="w-100 p-2" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Mobile Number</label>
                                <input type="text" wire:model="mobile_number" placeholder="Mobile Number" class="w-100 p-2" >
                                @error('mobile_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="">Date of Birth</label>
                                        <input type="date" wire:model="date_of_birth" placeholder="Date of Birth" class="w-100 p-2" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="">Sex</label>
                                        <input type="text" wire:model="sex" placeholder="Sex" class="w-100 p-2" disabled>
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
                                            <input type="text" wire:model="age" disabled placeholder="Age" class="w-100 p-2 mx-1">
                                            <input type="text" value="{{$age >= 60 ? 'Senior Citizen':'Not Senior Citizen'}}" disabled class="w-100 p-2 mx-1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">PWD</label>
                                        <input type="text" wire:model="pwd" placeholder="Not Disabled" class="w-100 p-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" wire:model="email" placeholder="Email Address" class="w-100 p-2 " >
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">District or Division</label>
                                <select wire:key="district" wire:model.change="district" id="district_option" class="w-100 p-2 ">
                                    <option selected value="" disabled>District</option>
                                    @foreach ($district_list as $value)
                                        <option value="{{ $value->district }}">{{ $value->district }}</option>
                                    @endforeach
                                </select>
                                @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">School or Station</label>
                                <select wire:model="school" id="school_option" class="w-100 p-2 ">
                                    <option value="" disabled>School</option>
                                    @foreach ($school_values as $value)
                                        <option value="{{ $value->school_name }}">{{ $value->school_name }}</option>
                                    @endforeach
                                </select >
                                @error('school')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="d-none" id="submitupdate"></button>
                    </form>

                    <div class="row p-3">
                        <hr>
                    </div>
                    
                <!--Subject Area-->
                @if (auth()->user()->category != 'Non-Teaching')
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Subject Area</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            <div class="col-md-12" id="subject-div">
                                @if (count($subject_area) > 0)
                                    <div class="row">
                                        @foreach ($subject_area as $subject)
                                        <div class="col-lg-2">
                                            <div class="d-inline mb-1">
                                                <div>
                                                    <input type="text" class="p-2 w-100" value="{{ ucfirst($subject->description).' ('.$subject->from.')' }} " disabled>
                                                    <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="subject" wire:click.prevent="deleteDetails({{0}}, {{ $subject->id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="form-group text-center">
                                        <span>No Subject Area Added Yet.</span>
                                    </div>
                                @endif
                                </div>
                                <div class="row">
                                    <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addMoreData({{ 0 }})" wire:key="subject">
                                            @csrf
                                            <div class="subject_group text-center">
                                                <div class="subject_select">
                                                    <select wire:model="subject_description" class="p-2 me-2">
                                                        <option value="" disabled>Subjects</option>
                                                        @foreach ($subject_lists as $subject)
                                                            <option value="{{ $subject->area }}">{{ $subject->area }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="d-flex flex-row justify-content-center">
                                                    <label for="subject_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="subject_from" class="p-2" id="subject_from" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success mx-1" wire:key="subject">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        <span class="text-muted mx-1">Must contain at least one</span>
                                        @error('subject_description')
                                            <div class="text-warning">{{ $message }}</div>
                                        @enderror
                                        @error('subject_from')
                                            <div class="text-warning">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                            <div class="col-md-12" id="career-div">
                                @if (count($career_service) > 0)
                                    @foreach ($career_service as $career)
                                    <div class="col-lg-2">
                                        <div class="d-inline mb-1">
                                            <div>
                                                <input type="text" class="p-2 w-100" value="{{ ucfirst($career->description).' ('.$career->from.' - '.$career->to.')' }} " disabled>
                                                <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="career" wire:click.prevent="deleteDetails({{1}}, {{ $career->id }})">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                            <div class="form-group text-center">
                                <span>No Career Service Added Yet.</span>
                            </div>
                            @endif
                            </div>
                            <div class="row">
                                <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addMoreData({{ 1 }})" wire:key="career">
                                            @csrf
                                            <div class="career_group text-center">
                                                <div class="career_select">
                                                    <input type="text" wire:model="career_description" class="p-1 me-2" placeholder="Enter Here" id="career_description">
                                                </div>
                                                <div class="d-flex flex-row  mb-2">
                                                    <label for="career_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="career_from" class="p-1 me-2" id="career_from" max="{{ $today }}" >
                                                </div>
                                                <div class="d-flex flex-row ">
                                                    <label for="career_to" class="me-2 mt-2">To</label>
                                                    <input type="date" wire:model="career_to" class="p-1 me-2" id="career_to" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success " wire:key="career">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('career_description')
                                            <div class="text-warning">{{ $message }}</div>
                                        @enderror
                                        @error('career_from')
                                            <div class="text-warning">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Educational Attainment Area-->
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Educational Attainments</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            <div id="doctorate">
                                <span class="fw-bold">Doctoral</span>
                                <div class="col-md-12" id="education-div">
                                    @if (count($educational_attainment_doctoral) > 0)
                                        @foreach ($educational_attainment_doctoral as $education)
                                        <div class="col-lg-2">
                                            <div class="d-inline mb-1">
                                                <div>
                                                    <input type="text" class="p-2 w-100" value="{{ ucfirst($education->description).' ('.$education->from.' - '.$education->to.')' }} " disabled>
                                                    <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="education" wire:click.prevent="deleteDetails({{2}}, {{ $education->id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="form-group text-center">
                                        <span>No Doctoral Added Yet.</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addEducation({{ 3 }})" wire:key="education">
                                            @csrf
                                            <div class="career_group text-center">
                                                <div class="career_select">
                                                    <input type="text" wire:model="education_description_doctorate" class="p-1 me-2" placeholder="Enter Here" id="education_description">
                                                </div>
                                                <div class="d-flex flex-row  mb-2">
                                                    <label for="doctorate_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="doctorate_from" class="p-1 me-2" id="doctorate_from" max="{{ $today }}" >
                                                </div>
                                                <div class="d-flex flex-row ">
                                                    <label for="doctorate_to" class="me-2 mt-2">To</label>
                                                    <input type="date" wire:model="doctorate_to" class="p-1 me-2" id="doctorate_to" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success " wire:key="education">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('education_description_doctorate')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('doctorate_from')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('doctorate_to')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="masterals">
                                <span class="fw-bold">Masteral</span>
                                <div class="col-md-12" id="education-div">
                                    @if (count($educational_attainment_masteral) > 0)
                                        @foreach ($educational_attainment_masteral as $education)
                                        <div class="col-lg-2">
                                            <div class="d-inline mb-1">
                                                <div>
                                                    <input type="text" class="p-2 w-100" value="{{ ucfirst($education->description).' ('.$education->from.' - '.$education->to.')' }} " disabled>
                                                    <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="education" wire:click.prevent="deleteDetails({{2}}, {{ $education->id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="form-group text-center">
                                        <span>No Masteral Added Yet.</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addEducation({{ 2 }})" wire:key="education">
                                            @csrf
                                            <div class="career_group text-center">
                                                <div class="career_select">
                                                    <input type="text" wire:model="education_description_masteral" class="p-1 me-2" placeholder="Enter Here" id="education_description">
                                                </div>
                                                <div class="d-flex flex-row  mb-2">
                                                    <label for="masteral_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="masteral_from" class="p-1 me-2" id="masteral_from" max="{{ $today }}" >
                                                </div>
                                                <div class="d-flex flex-row ">
                                                    <label for="masteral_to" class="me-2 mt-2">To</label>
                                                    <input type="date" wire:model="masteral_to" class="p-1 me-2" id="masteral_to" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success " wire:key="education">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('education_description_masteral')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('masteral_from')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('masteral_to')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="baccalaureate">
                                <span class="fw-bold">Baccalaureate</span>
                                <div class="col-md-12" id="education-div">
                                    @if (count($educational_attainment_baccalaureate) > 0)
                                        @foreach ($educational_attainment_baccalaureate as $education)
                                        <div class="col-lg-2">
                                            <div class="d-inline mb-1">
                                                <div>
                                                    <input type="text" class="p-2 w-100" value="{{ ucfirst($education->description).' ('.$education->from.' - '.$education->to.')' }} " disabled>
                                                    <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="education" wire:click.prevent="deleteDetails({{2}}, {{ $education->id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="form-group text-center">
                                        <span>No Baccalaureate Added Yet.</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addEducation({{ 1 }})" wire:key="education">
                                            @csrf
                                            <div class="career_group text-center">
                                                <div class="career_select">
                                                    <input type="text" wire:model="education_description_baccalaureate" class="p-1 me-2" placeholder="Enter Here" id="education_description">
                                                </div>
                                                <div class="d-flex flex-row  mb-2">
                                                    <label for="baccalaureate_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="baccalaureate_from" class="p-1 me-2" id="baccalaureate_from" max="{{ $today }}" >
                                                </div>
                                                <div class="d-flex flex-row ">
                                                    <label for="baccalaureate_to" class="me-2 mt-2">To</label>
                                                    <input type="date" wire:model="baccalaureate_to" class="p-1 me-2" id="baccalaureate_to" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success " wire:key="education">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('education_description_baccalaureate')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('baccalaureate_from')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('baccalaureate_to')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="others">
                                <span class="fw-bold">Others</span>
                                <div class="col-md-12" id="education-div">
                                    @if (count($educational_attainment_others) > 0)
                                        @foreach ($educational_attainment_others as $education)
                                        <div class="col-lg-2">
                                            <div class="d-inline mb-1">
                                                <div>
                                                    <input type="text" class="p-2 w-100" value="{{ ucfirst($education->description).' ('.$education->from.' - '.$education->to.')' }} " disabled>
                                                    <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="education" wire:click.prevent="deleteDetails({{2}}, {{ $education->id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="form-group text-center">
                                        <span>No Other Attainment Added Yet.</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                        <form wire:submit.prevent="addEducation({{ 0 }})" wire:key="education">
                                            @csrf
                                            <div class="career_group text-center">
                                                <div class="career_select">
                                                    <input type="text" wire:model="education_description_others" class="p-1 me-2" placeholder="Enter Here" id="education_description">
                                                </div>
                                                <div class="d-flex flex-row  mb-2">
                                                    <label for="others_from" class="me-2 mt-2">From</label>
                                                    <input type="date" wire:model="others_from" class="p-1 me-2" id="others_from" max="{{ $today }}" >
                                                </div>
                                                <div class="d-flex flex-row ">
                                                    <label for="others_to" class="me-2 mt-2">To</label>
                                                    <input type="date" wire:model="others_to" class="p-1 me-2" id="others_to" max="{{ $today }}">
                                                    <button type="submit" class="rounded-0 btn btn-success " wire:key="education">+</button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('education_description_others')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('others_from')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                        @error('others_to')
                                            <div class="text-warning message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!--Grade Level Taught-->
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-2">Grade Level Taught</label>
                        <div class="w-100 border bg-transparent p-3 mb-1">
                            <div class="col-md-12" id="subject-div">
                                @if (count($grade_level_taught) > 0)
                                    @foreach ($grade_level_taught as $grade)
                                    <div class="col-lg-2">
                                        <div class="d-inline mb-1">
                                            <div>
                                                <input type="text" class="p-2 w-100" value="{{ ucfirst($grade->grade_level).' ('.$grade->from.' - '.$grade->to.')' }} " disabled>
                                                <button type="button" class="mb-3 btn btn-danger rounded-0 w-100" wire:key="career" wire:click.prevent="deleteDetails({{3}}, {{ $grade->id }})">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="form-group text-center">
                                        <span>No Grade Level Taught Added Yet.</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="form-group border w-100 bg-transparent p-1 m-auto">
                                    <form wire:submit.prevent="addMoreData({{2}})" wire:key="grade_level">
                                        @csrf
                                        <div class="career_group text-center">
                                            <div class="career_select">
                                                <select wire:model="grade_level" class="p-1 me-2">
                                                    <option value="" disabled>Grade Level</option>
                                                    @foreach ($grade_level_list as $grade)
                                                        <option value="{{ $grade->grade_level }}">{{ $grade->grade_level }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex flex-row  mb-2">
                                                <label for="grade_level_from" class="me-2 mt-2">From</label>
                                                <input type="date" wire:model="grade_level_from" class="p-1 me-2" id="grade_level_from" max="{{ $today }}" >
                                            </div>
                                            <div class="d-flex flex-row ">
                                                <label for="grade_level_to" class="me-2 mt-2">To</label>
                                                <input type="date" wire:model="grade_level_to" class="p-1 me-2" id="grade_level_to" max="{{ $today }}">
                                                <button type="submit" class="rounded-0 btn btn-success " wire:key="grade_level">+</button>
                                            </div>
                                        </div>
                                    </form>
                                    @error('grade_level')
                                        <div class="text-warning">{{ $message }}</div>
                                    @enderror
                                    @error('grade_level_from')
                                        <div class="text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

        
    <!-- Editing and Viewing Photo-->
    <div class="zoom-photo--{{ $employee_id }} d-none" id="zoom-photo">
        @if ($image)
        <img src="{{ asset('assets/images/'.$image) }}" id="zoomed-img">
        @else
        <img src="{{ asset('assets/images/avatar.png') }}"  id="zoomed-img">
        @endif
        <span class="close-icon" data="{{ $employee_id }}"><i class="bi bi-x-circle"></i></span>  
    </div>

    <!--Change Profile form-->
    <form action="{{ route('userchangepicture', $employee_id) }}" method="POST" id="picture_change">
        @csrf
        @method('PUT')
        <input name="image" type="file" accept=".png, .jpg, .jpeg" class="d-none" id="image-upload">
        <input type="text" name="old_image" value="{{ $image }}" class="d-none">
        <input type="submit" id="picture_change_btn" class="d-none">
    </form>

    <script>
        $(document).ready(function(){
            $('select#district_option').on('change', function(){
               @this.set('school', "");
            });
        });
    </script>
</div>
