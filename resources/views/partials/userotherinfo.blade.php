<form action="" method="POST">
    @method('PUT')
    @csrf
    <div class="modal fade" id="view-admin-modal{{ $employee->employee_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">User Information</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="modal-button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            @if ($employee->image)
                            <img src="{{ asset('assets/images/'.$employee->image) }}" class="photo m-0" style="cursor: pointer" id="img-sizable">
                            @else
                            <img src="{{ asset('assets/images/avatar.png') }}" class="photo m-0" style="cursor: pointer" id="img-sizable">
                            @endif  
                            <div id="name" class="mb-2"><b>{{ ucwords($employee->first_name). ' '. ucfirst(substr($employee->middle_name, 0,1)). ' '.ucwords($employee->last_name) }}</b></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="employee_id" class="updatable p-2 mb-2 w-100 return ($employee->employee_id) ? fw-bold : 'fw-lighter' " value="{{ $employee->employee_id }}" placeholder="Employee ID" disabled>
                                <div class="text-danger message error-text employee_id_error"></div>
                            </div>
                            <div class="form-group">
                                <select name="position" class="updatable p-2 mb-2 w-100 return ($employee->position) ? fw-bold : 'fw-lighter' " disabled>
                                    @if ($employee->position)
                                    <option disabled>POSITION</option>
                                    <option selected value="{{ $employee->position }}">{{ strtoupper($employee->position) }}</option>
                                    <option value="teaching">TEACHING</option>
                                    <option value="non-teaching">NON-TEACHING</option>
                                    <option value="eps">EPS</option>
                                    <option value="psds">PSDS</option>
                                    <option value="sds">SDS</option>
                                    <option value="osds">OSDS UNIT HEAD</option>
                                    <option value="school-head">SCHOOL HEAD</option>
                                    <option value="hr">HR</option>
                                    <option value="seps">SEPS</option>
                                    <option value="eps-ii">EPS-II</option>
                                    @else
                                    <option selected disabled>POSITION</option>
                                    <option value="teaching">TEACHING</option>
                                    <option value="non-teaching">NON-TEACHING</option>
                                    <option value="eps">EPS</option>
                                    <option value="psds">PSDS</option>
                                    <option value="sds">SDS</option>
                                    <option value="osds">OSDS UNIT HEAD</option>
                                    <option value="school-head">SCHOOL HEAD</option>
                                    <option value="hr">HR</option>
                                    <option value="seps">SEPS</option>
                                    <option value="eps-ii">EPS-II</option>
                                    @endif
                                </select >
                                <div class="text-danger message error-text position_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="salary" class="updatable p-2 mb-2 w-100 return ($employee->salary) ? fw-bold : 'fw-lighter' " value="{{ $employee->salary }}" placeholder="Salary" disabled>
                                <div class="text-danger message error-text salary_error"></div>
                            </div>
                            <div class="form-group">
                                <select name="sex" class="updatable p-2 mb-2 w-100 return ($employee->sex) ? fw-bold : 'fw-lighter' " disabled>
                                    @if ($employee->sex)
                                    <option disabled>SEX</option>
                                    <option selected value="{{ $employee->sex }}">{{ strtoupper($employee->sex) }}</option>
                                    <option value="male">MALE</option>
                                    <option value="female">FEMALE</option>
                                    @else
                                    <option selected disabled>SEX</option>
                                    <option value="male">MALE</option>
                                    <option value="female">FEMALE</option>
                                    @endif
                                </select>
                                <div class="text-danger message error-text sex_error"></div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" name="date_of_birth" class="updatable p-2 mb-2 w-100 return ($employee->date_of_birth) ? fw-bold : 'fw-lighter' " value="{{ $employee->date_of_birth }}" placeholder="Date of Birth" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" name="years_in_service" class="updatable p-2 mb-2 w-100 return ($employee->years_in_service) ? fw-bold : 'fw-lighter' " value="{{ $employee->years_in_service }}" placeholder="Years in Service" disabled>
                                <div class="text-danger message error-text years_in_service_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="mobile_number" class="updatable p-2 mb-2 w-100 return ($employee->mobile_number) ? fw-bold : 'fw-lighter' " value="{{ $employee->mobile_number }}" placeholder="Mobile Number" disabled>
                                <div class="text-danger message error-text mobile_number_error"></div>
                            </div>
                            <div class="form-group">
                                <div class="p-2 w-100 mb-2 border">
                                   <span class="fw-bold text-muted">Subject Area</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="district" class="updatable p-2 mb-2 w-100 return ($employee->district) ? fw-bold : 'fw-lighter' " disabled>
                                    @if ($employee->district)
                                    <option disabled>DISTRICT</option>
                                    <option selected value="{{ $employee->dsitrict }}">{{ strtoupper($employee->dsitrict) }}</option>
                                    <option value="i" >I</option>
                                    <option value="ii">II</option>
                                    @else
                                    <option selected disabled>District</option>
                                    <option value="i" >I</option>
                                    <option value="ii">II</option>
                                    @endif
                                </select >
                            </div>
                            <div class="form-group">
                                <div class="p-2 mb-2 w-100 border">
                                    <span class="fw-bold text-muted">Educational Attainment</span>
                                 </div>
                            </div>
                            <div class="form-group">
                                <div class="p-2 mb-2 w-100 border">
                                    <span class="fw-bold text-muted">Career Service</span>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-edit" ><i class="bi bi bi-pencil-square"></i></button>
                <input type="reset" class="btn btn-secondary d-none btn-cancel" value="Cancel">
                <input type="submit" class="btn btn-warning d-none btn-save" value="Save">
            </div>
          </div>
        </div>
      </div>
    </form>
    