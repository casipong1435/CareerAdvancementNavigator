<?php

namespace App\Http\Controllers;

use App\Models\AttendedTraining;
use App\Models\CareerService;
use App\Models\EducationalAttainment;
use App\Models\OfficialTraining;
use App\Models\RecommendedParticipant;
use App\Models\SelectedParticipant;
use App\Models\PendingTraining;
use App\Models\GradeLevelTaught;;
use App\Models\Profiles;
use App\Models\SubjectArea;
use App\Models\otp;
use App\Models\attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Crypt;
use PDF;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    //
    public function __construct()
    {
       
    }

    public function userHome()
    {
        return view('user.home');
    }

    public function profile()
    {

        return view('user.profile');
    }

    public function mytraining()
    {
        
        return view('user.mytraining');
    }

    public function mypendingtraining()
    {  
        return view('user.mypendingtraining');
    }

    public function myaddedtraining()
    {  
        return view('user.training-category.added');
    }

    public function gadsurveyquestion()
    {  
        return view('user.gadsurveyquestion');
    }

    public function myattendedtraining()
    {  
        return view('user.training-category.attended');
    }

    public function myongoingtraining()
    {  
        return view('user.training-category.ongoing');
    }

    public function myupcomingtraining()
    {  
        return view('user.training-category.upcoming');
    }

    public function subordinate()
    { 
        return view('user.subordinate');
    }

    public function subordinateprofile($employee_id)
    {
        $user_id = Crypt::decrypt($employee_id);

        $userdata = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                        ->where('users.employee_id', $user_id)->first();

        $user_subject_area = SubjectArea::where('employee_id', $user_id)->get();
        $user_career_service = CareerService::where('employee_id', $user_id)->get();
        $user_grade_level_taught = GradeLevelTaught::where('employee_id', $user_id)->orderBy('from', 'desc')->get();
        $attended_training = AttendedTraining::join('official_trainings', 'attended_trainings.training_id', 'official_trainings.training_id')
                                                    ->where('employee_id', $user_id)
                                                    ->get();

        $user_educational_attainment_doctoral = EducationalAttainment::where('employee_id', $user_id)->where('level', 2)->get();
        $user_educational_attainment_masteral = EducationalAttainment::where('employee_id', $user_id)->where('level', 1)->get();
        $user_educational_attainment_others = EducationalAttainment::where('employee_id', $user_id)->where('level', 0)->get();
                    
        return view('user.subordinateprofile', [
            'userdata' => $userdata, 
            'user_subject_area' => $user_subject_area, 
            'user_career_service' => $user_career_service, 
            'user_educational_attainment_doctoral' => $user_educational_attainment_doctoral,
            'user_educational_attainment_masteral' => $user_educational_attainment_masteral,
            'user_educational_attainment_others' => $user_educational_attainment_doctoral,
            'attended_training' => $attended_training, 
            'user_grade_level_taught' => $user_grade_level_taught
        ]);
    }

    public function userattendance()
    {
        $employee_id = auth()->user()->employee_id;
        $attended_training = attendance::distinct()->join('official_trainings', 'attendances.training_id', 'official_trainings.training_id')
                                                    ->where('employee_id', $employee_id)
                                                    ->get(['official_trainings.training_id','training_title','start_of_conduct','end_of_conduct', 'status']);
        
        return view('user.attendance', ['attended_training' => $attended_training]);
    }

    public function upcomingtraining()
    {
        $ongoing_trainings = OfficialTraining::where('status', 0)->get(['training_id', 'training_title', 'start_of_conduct', 'end_of_conduct']);
        
        return view('user.upcomingtraining', ['ongoing_trainings' => $ongoing_trainings]);
    }

    public function viewupcomingtraining($id)
    {
        $id = Crypt::decrypt($id);
        
        return view('user.upcomingtraining_info', ['training_id' => $id]);
    }

    public function viewuserattendance($id)
    {
        $id = Crypt::decrypt($id);

        return view('user.attendance_info', ['id' => $id]);
    }

    public function addattendance(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'employee_id' => 'required|exists:users,employee_id',
            'otp' => 'required|exists:otps,otp'
        ],
        [
            'otp.exists' => 'The OTP you enter is invalid!',
            'employee_id.exists' => 'The Employee ID you enter does not exist in the system!'
        ]);

        if (!$validator->passes()){
            return response()->json(['status'=> 0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $check_otp = otp::where('otp',$request->otp)->where('status', 0)->first();
            
            if ($check_otp){
                $today = Carbon::now('Asia/Manila')->format('Y-m-d');
                

                $check_attendance = attendance::where('employee_id', $request->employee_id)->where('date_attended', $today)->count();

                if ($check_attendance > 0){
                    return response()->json(['status' => 1, 'msg' => 'You already submitted your attendance!']);
                }else{
                    
                    if($check_otp->date_created == $today){
                        attendance::create(['employee_id' => $request->employee_id, 'training_id' => $check_otp->training_id, 'date_attended' => $today, 'logged_in' => Carbon::now('Asia/Manila')]);
                        otp::where('otp', $request->otp)->update(['status' => 1]);
                        return response()->json(['status' => 2, 'msg' => 'Attendance Submitted!', 'link' => route('myongoingtraining')]);
                    }else{
                        return response()->json(['status' => 4, 'msg' => 'OTP is not available!']);
                    }
                    
                }

            }else{
                return response()->json(['status' => 3, 'msg' => 'OTP have been used by someone else!']);
            }

        }
    }

    public function pdfaddedtraining($from, $to,$employee_id)
    {
        $user_info = Profiles::leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
                            ->where('profiles.employee_id', $employee_id)->first(['first_name', 'last_name', 'profiles.employee_id', 'position']);
        $added_training = PendingTraining::where('status', 1)
                        ->where('start_of_conduct', '>=', $from)
                        ->where('start_of_conduct', '<=', $to)
                        ->where('employee_id', $employee_id)
                        ->get();
        
        $myadded_training = PDF::loadView('pdf.myadded-training', ['added_training' => $added_training, 'user_info' => $user_info]);
        //return $conducted_training->download('attended-training - '.$year.'.pdf');
        return $myadded_training->stream('pdf.myadded-training');
    }

    public function pdfattendedtraining($from, $to, $employee_id)
    {
        $user_info = Profiles::leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
                            ->where('profiles.employee_id', $employee_id)->first(['first_name', 'last_name', 'profiles.employee_id', 'position']);
        $attended_training = AttendedTraining::leftJoin('official_trainings','attended_trainings.training_id', '=','official_trainings.training_id')
                        ->where('start_of_conduct', '>=', $from)
                        ->where('start_of_conduct', '<=', $to)
                        ->where('attended_trainings.employee_id', $employee_id)
                        ->get();
        
        $myattended_training = PDF::loadView('pdf.myattended-training', ['attended_training' => $attended_training, 'user_info' => $user_info]);
        //return $conducted_training->download('attended-training - '.$year.'.pdf');
        return $myattended_training->stream('pdf.myattended-training');
    }
}
