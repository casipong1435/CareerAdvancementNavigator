<div>
    <div class="row">
        @include('partials.navigation')

    <div class="container-fluid bg-white">

        @if (session()->has('success'))
            <div class="p-3">
                <div class="alert alert-success alert-dismissible fade show message" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-3">
                <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                    <strong>Error!</strong> {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="container py-3 d-flex justify-content-center align-items-center" wire:ignore.self>
                <div class="row w-100" id="form-container">
                    <form wire:submit.prevent="RegisterUser" wire:key="RegisterUser">
                        @csrf
                        <div class="col-md-12 mx-auto">
                            <div class="row">
                                <div class="form-group mb-3 title-bar">
                                    <div class="col-md-3 w-100 mb-2">
                                        <span class="h1"><b>Register </b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center flex-column title-bar">
                                    <div class="form-group custom-textbox">
                                        <select class="p-2 mb-2 w-100 textbox-reg" wire:model.live="category">
                                            <option disabled value="">Category</option>
                                            @foreach ($category_values as $value)
                                                <option value="{{ $value->category }}">{{ $value->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <select class="p-2 mb-2 w-100 textbox-reg" wire:model="position">
                                            <option disabled value="">Position</option>
                                            @foreach ($position_values as $value)
                                                <option value="{{ $value->position }}">{{ $value->position }}</option>
                                            @endforeach
                                        </select>
                                        @error('position')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="text" class="p-2 mb-1 w-100 textbox-reg" placeholder="Employee ID" wire:model="employee_id">
                                        @error('employee_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="text" class="p-2 mb-1 w-100 textbox-reg" placeholder="First Name" wire:model="first_name">
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="text" class="p-2 mb-1 w-100 textbox-reg" placeholder="Middle Name (Optional)" wire:model="middle_name">
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="text" class="p-2 mb-1 w-100 textbox-reg" placeholder="Last Name" wire:model="last_name">
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center flex-column">
                                    <div class="form-group custom-textbox">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="py-2">Date of Birth</label>
                                                <br>
                                                <input type="date" class="w-100 p-2 mb-1 date-input" id="dob"  wire:model="date_of_birth">
                                                @error('date_of_birth')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="py-2">Sex</label>
                                                <br>
                                                <select class="cmb-sex p-2 w-100" wire:model="sex">
                                                    <option selected disabled>select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                @error('sex')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="email" class="w-100 p-2 mb-1 textbox-reg" placeholder="Email Address" wire:model="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="text" class="w-100 p-2 mb-1 textbox-reg" placeholder="Mobile Number" wire:model="mobile_number" value="{{ old('mobile_number') }}">
                                        @error('mobile_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="password" class="w-100 p-2 mb-1 textbox-reg" placeholder="Password" wire:model="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox">
                                        <input type="password" class="w-100 p-2 mb-3 textbox-reg" placeholder="Confirm Password" wire:model="confirm_password" >
                                        @error('confirm_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-textbox text-center">
                                        <button type="button" class="p-2 mb-3 w-50 selfie-btn text-center" id="accesscamera" data-bs-toggle="modal"  data-bs-target="#photoModal">
                                            Take Selfie
                                        </button>
                                        <input type="hidden" id="photoStore" class="p-2 mb-4 img-file image-tag" wire:model="image">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group custom-textbox">
                                        <button type="submit" class="p-2 register-btn mb-1 w-100" id="" onclick="">
                                            Register
                                            <div wire:loading wire:target="RegisterUser" wire:key="Register">
                                                <span class="spinner-grow-sm text-light" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </span>
                                                <span class="spinner-grow-sm text-light" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </span>
                                                <span class="spinner-grow-sm text-light" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal for TAKE SELFIE-->
<div wire:ignore wire:key="photomodal" class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Capture Your Face</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="close-modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
                <div id="result" class="d-none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-takephoto mx-auto text-white" id="takephoto">
                    <div class="takephoto-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg>
                    </div>
                </button>
                <button type="button" class="btn-retakephoto mx-auto text-white d-none" id="retakephoto">
                    <div class="retakephoto-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg>
                    </div>
                </button>
                <button type="submit" class="btn-uploadphoto mx-auto text-white d-none close" data-bs-dismiss="modal" aria-label="Close" id="uploadphoto">
                    <div class="uploadphoto-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function(){
            Webcam.set({
                width: 320,
                height: 240,
                image_format: "jpeg",
                jpeg_quality: 90
            });

            $("#accesscamera").on('click', function(){
                Webcam.reset();
                Webcam.on('error', function(){
                    $('#photoModal').modal('hide');
                    swal({
                        title: 'Warning',
                        text: 'Please give permission to access your camera',
                        icon: 'warning'
                    });
                });

                Webcam.attach('#my_camera');
            });

            $('#takephoto').on('click', take_snapshot);

            $("#retakephoto").on('click', function(){
                $('#my_camera').addClass('d-block');
                $('#my_camera').removeClass('d-none');

                $('#result').addClass('d-none');

                $('#takephoto').addClass('d-block');
                $('#takephoto').removeClass('d-none');

                $('#retakephoto').addClass('d-none');
                $('#retakephoto').removeClass('d-block');

                $('#uploadphoto').addClass('d-none');
                $('#uploadphoto').removeClass('d-block');
            });

            $(".btn-uploadphoto").on('click', function(){
                Webcam.reset();
            });

            $('#close_modal').on('click', function(){
                Webcam.reset();
            });
        });

        function take_snapshot(){
            Webcam.snap(function(data_uri){
                $('#result').html('<img src=" '+ data_uri +' "class="d-block mx-auto rounded" width="280" height="240"/>');
                
                
                var raw_image_data = data_uri.replace('data:image/jpeg;base64,', '');
                //$('#photoStore').val(raw_image_data);
                @this.set('image', raw_image_data);
            });

            $('#my_camera').removeClass('d-block');
            $('#my_camera').addClass('d-none');

            $('#result').removeClass('d-none');
            $('#result').addClass('d-block');

            $('#takephoto').removeClass('d-block');
            $('#takephoto').addClass('d-none');

            $('#retakephoto').removeClass('d-none');
            $('#retakephoto').addClass('d-block');

            $('#uploadphoto').removeClass('d-none');
            $('#uploadphoto').addClass('d-block');
        }

    </script>
</div>
