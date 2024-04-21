<?php

namespace App\Http\Controllers;

use App\Models\AttendedTraining;
use App\Models\CareerService;
use App\Models\EducationalAttainment;
use App\Models\OfficialTraining;
use App\Models\PendingTraining;
use App\Models\Profiles;
use App\Models\SubjectArea;
use App\Models\User;
use App\Models\school;
use App\Models\otp;
use App\Models\Criteria;
use App\Models\SelectedParticipant;
use App\Models\RecommendedParticipant;
use App\Models\attendance;
use App\Models\GadAssessmentAnswer;
use App\Models\GadAssessmentQuestion;

use Illuminate\Support\Facades\Validator;

use Auth;
use Crypt;
use PDF;

use DB;
use Session;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //Admin Controls

    public function adminHome()
    {
        $today = Carbon::now('Asia/Manila');

        $employee_id = auth()->user()->employee_id;
        $profile = Profiles::where('employee_id', $employee_id)->first('first_name');
        $pending_user_count = User::where('status', 0)->count();
        $female_user_count = Profiles::leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')->where('sex', 'female')->whereNot('position', 'HR')->where('status', '1')->where('job_status', 1)->count();
        $male_user_count = Profiles::leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')->where('sex', 'male')->whereNot('position', 'HR')->where('status', '1')->where('job_status', 1)->count();
        $total_user_count = User::where('status', '1')->whereNot('position', 'HR')->where('job_status', 1)->count();
        $pending_training_count = PendingTraining::where('status', 0)->count();
        $ongoing_training = OfficialTraining::where('status', 0)
                                            ->where('start_of_conduct', '<=', $today)
                                            ->count();
        $upcoming_training = OfficialTraining::where('status', 0)
                                            ->where('start_of_conduct', '>', $today)
                                            ->count();
        $finished_training = OfficialTraining::where('status', 1)
                                            ->count();


        //Senior Citizen Sex Disaggregated Data

        $teaching_senior = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching')
        ->where('age', '>=', 60)
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $non_teaching_senior = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Non-Teaching')
        ->where('age', '>=', 60)
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $teaching_related_senior = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching Related')
        ->where('age', '>=', 60)
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        //PWD Sex Disaggregated Data

        $teaching_pwd = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching')
        ->where('pwd', '!=', '')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $non_teaching_pwd = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Non-Teaching')
        ->where('pwd', '!=', '')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $teaching_related_pwd = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching Related')
        ->where('pwd', '!=', '')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        //Employee Sex Disaggregated Data
        
        $teaching_personnel = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $non_teaching_personnel = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Non-Teaching')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        $teaching_related_personnel = Profiles::select([
            \DB::raw('sex, COUNT(*) as count')])
        ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
        ->where('category', 'Teaching Related')
        ->whereNot('position', 'HR')
        ->where('users.status', 1)
        ->where('job_status', 1)
        ->groupBy('sex')
        ->get()
        ->pluck('count', 'sex');

        return view('admin.home', [
            'pending_user_count' => $pending_user_count, 
            'pending_training_count' => $pending_training_count,
            'female_user_count' => $female_user_count,
            'male_user_count' => $male_user_count,
            'total_user_count' => $total_user_count,
            'ongoing_training' => $ongoing_training,
            'upcoming_training' => $upcoming_training,
            'finished_training' => $finished_training,
            'profile' => $profile,
            'today' => $today,
            'teaching_personnel' => $teaching_personnel,
            'non_teaching_personnel' => $non_teaching_personnel,
            'teaching_related_personnel' => $teaching_related_personnel,
            'teaching_senior' => $teaching_senior,
            'non_teaching_senior' => $non_teaching_senior,
            'teaching_related_senior' => $teaching_related_senior,
            'teaching_pwd' => $teaching_pwd,
            'non_teaching_pwd' => $non_teaching_pwd,
            'teaching_related_pwd' => $teaching_related_pwd
        ]);
    }

    public function pendingaccount()
    {
        $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                                ->where('users.status', 0)->get();

        return view('admin.account-category.pending', ['employees' => $employees]);
    }

    public function upcomingtraining()
    {
        return view('admin.training-category.upcoming');
    }

    public function ongoingtraining()
    {
        return view('admin.training-category.ongoing');
    }

    public function verifytraining()
    {
        return view('admin.training-category.verification');
    }

    public function finishedtraining()
    {
        return view('admin.training-category.finished');
    }

    public function accountlist()
    {               
        return view('admin.account-category.users');
    }

    public function gadquestion()
    {               
        Session::put('gadquestion', true);
        Session::forget('gadsurvey');
        return view('admin.gadquestion');
    }

    public function gadsurvey()
    {               
        Session::put('gadsurvey', true);
        Session::forget('gadquestion');
        return view('admin.gadsurvey');
    }

    public function viewuserprofile($employee_id)
    {
        $decrypted_employee_id = Crypt::decrypt($employee_id);

        return view('admin.userprofile', ['decrypted_employee_id' => $decrypted_employee_id]);
    }

    public function administrator()
    {
        return view('admin.account-category.admins');
    }

    public function createtraining()
    {
        return view('admin.createtraining');
    }

    public function conductedtraining()
    {
        return view('admin.conductedtraining');
    }

    public function gadreport()
    {
        return view('admin.gadreport');
    }

    public function traininglist()
    {
        
        return view('admin.traininglist');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function pendingtraining()
    {
        return view('admin.pendingtraining');
    }

    public function adminattendance()
    {
        return view('admin.attendance');
    }

    public function school()
    {
        return view('admin.school');
    }

    public function positioncategory()
    {
        return view('admin.position-category-list');
    }

    public function viewtraininginfo($training_id)
    {
        $training_id = Crypt::decrypt($training_id);
        
        return view('admin.created_training_info', ['training_id' => $training_id]);
    }

    public function generateotp(Request $request)
    {
        $otp_num = $request->otp_count;
        for ($i = 0; $i < $otp_num; $i++){

            $OTP = Str::random(5);
            otp::create(['training_id' => $request->training_id,'status' => 0, 'otp' => $OTP, 'date_created' => $request->date_created]);
        }

        return redirect()->back();
    }

    public function ViewTrainingParticipant($training_id){
        $training_id = Crypt::decrypt($training_id);

        return view('admin.participant-list', ['training_id' => $training_id]);
    }

    public function viewattendanceinfo($id)
    {
        $training_info = OfficialTraining::where('training_id', $id)->first();

        return view('admin.attendance_info', ['training_info' => $training_info]);
    }

    public function adminEditTraining(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            "training_title" => 'required',
            "start_of_conduct" => 'required',
            "end_of_conduct" => 'required',
            "conducted_by" => 'required',
            "type_of_ld" => 'required',
            "source_of_budget" => 'required',
            "service_provider" => 'required',
            "responsible_unit" => 'required',
            "number_of_participants" => 'required',
            "venue" => 'required',
            "training_type" => 'required',
            "reference" => 'required',

        ]);

        if(!$validator->passes()){
            return response()->json(['status'=> 0, 'error'=>$validator->errors()->toArray()]);
        }else{

            $start_date = Carbon::parse($request->start_of_conduct);
            $end_date = Carbon::parse($request->end_of_conduct);
            $number_of_days = $start_date->diffInDays($end_date) + 1;

            $number_of_hours = ($number_of_days * 8);

            if($request->training_type == 'Others'){
                $request->training_type = $request->other_training_type;
            }

            if($request->service_provider == 'Others'){
                $request->service_provider = $request->other_service_provider;
            }

            if($request->conducted_by == 'Others'){
                $request->conducted_by = $request->other_conducted_by;
            }

            if($request->type_of_ld == 'Others'){
                $request->type_of_ld = $request->other_type_of_ld;
            }

            if($request->source_of_budget == 'Others'){
                $request->source_of_budget = $request->other_source_of_budget;
            }

            $values = [
                'training_title' => $request->training_title,
                'start_of_conduct' => $request->start_of_conduct,
                'end_of_conduct' => $request->end_of_conduct,
                'number_of_hours' => $number_of_hours,
                'conducted_by' => $request->conducted_by,
                'type_of_ld' => $request->type_of_ld,
                'source_of_budget' => $request->source_of_budget,
                'service_provider' => $request->service_provider,
                'responsible_unit' => $request->responsible_unit,
                'number_of_participants' => $request->number_of_participants,
                'venue' => $request->venue,
                'training_type' => $request->training_type,
                'reference' => $request->reference,
            ];

            $query1 = OfficialTraining::where('training_id', $id)->update($values);

            if ($query1){
                
                return response()->json(['status'=> 1, 'msg'=>'Updated Successfully!']);
                
            }
            
        }
    }

    public function printotp($date_created)
    {
        $otp_list = otp::where('date_created', $date_created)->get();
        $otp_pdf = PDF::loadView('pdf.otp', ['otp_list' => $otp_list]);
        return $otp_pdf->stream('pdf.otp');
    }

    public function printConductedTraining($from, $to)
    {
        $year = Carbon::createFromFormat('Y-m-d', $from)->format('Y');
        $training_info = OfficialTraining::withCount('attendedTrainings')
                            ->join('attended_trainings', 'official_trainings.training_id', '=', 'attended_trainings.training_id')
                            ->join('profiles', 'attended_trainings.employee_id', '=', 'profiles.employee_id')
                            ->where('start_of_conduct', '>=', $from)
                            ->where('start_of_conduct', '<=', $to)
                            ->where('status', 1)
                            ->orderBy('start_of_conduct', 'desc')
                            ->distinct()
                            ->get();
                    
        
        $conducted_training = PDF::loadView('pdf.conducted-training', ['training_info' => $training_info, 'year' => $year]);
        //return $conducted_training->download('conducted-training - '.$year.'.pdf');
        return $conducted_training->stream('pdf.conducted-training');
    }

    public function printGADReport($from, $to)
    {
        $year = Carbon::createFromFormat('Y-m-d', $from)->format('Y');

        $training_info = OfficialTraining::select([
            'official_trainings.training_id',
            'official_trainings.training_title',
            'official_trainings.start_of_conduct',
            'official_trainings.end_of_conduct',
            'official_trainings.number_of_hours',
            'official_trainings.type_of_ld',
            'official_trainings.source_of_budget',
            'official_trainings.responsible_unit',
            \DB::raw('ROUND(SUM(salary_grades.salary / 22) * (official_trainings.number_of_hours)) as budget'),
        ])
            ->leftJoin('attended_trainings', 'official_trainings.training_id', '=', 'attended_trainings.training_id')
            ->leftJoin('profiles', 'attended_trainings.employee_id', '=', 'profiles.employee_id')
            ->leftJoin('users', 'profiles.employee_id', '=', 'users.employee_id')
            ->leftJoin('salary_grades', 'users.position', '=', 'salary_grades.position')
            ->whereIn('official_trainings.conducted_by', ['SGOD', 'CID', 'OSDS'])
            ->where('official_trainings.status', 1)
            ->where('training_type', 'GAD')
            ->groupBy([
                'official_trainings.training_id',
                'official_trainings.training_title',
                'official_trainings.start_of_conduct',
                'official_trainings.end_of_conduct',
                'official_trainings.number_of_hours',
                'official_trainings.type_of_ld',
                'official_trainings.source_of_budget',
                'official_trainings.responsible_unit',
            ])
            ->withCount('attendedTrainings')
                            ->withCount([
                                'attendedTrainings as male_count' => function ($query) {
                                    $query->whereHas('employee', function ($query) {
                                        $query->where('sex', 'male');
                                    });
                                },
                                'attendedTrainings as female_count' => function ($query) {
                                    $query->whereHas('employee', function ($query) {
                                        $query->where('sex', 'female');
                                    });
                                }
                            ])
            ->having(\DB::raw('COUNT(attended_trainings.id)'), '>', 0) // Ensures at least one attendee
            ->orderBy('official_trainings.start_of_conduct', 'asc')
            ->get();
            
        $gad_report = PDF::loadView('pdf.gadreport', ['training_info' => $training_info, 'year' => $year]);
        //return $conducted_training->download('conducted-training - '.$year.'.pdf');
        return $gad_report->stream('pdf.gad-report');
    }
    
    public function printAttendance($from, $to, $training_id)
    {
        $training_info = OfficialTraining::where('training_id', $training_id)->first();
        $user_attended = User::join('profiles', 'users.employee_id', 'profiles.employee_id')
                                    ->join('attendances', 'users.employee_id', 'attendances.employee_id')
                                    ->where('training_id', $training_id)
                                    ->where('date_attended', '>=', $from)
                                    ->where('date_attended', '<=', $to)
                                     ->orderBy('logged_in', 'asc')
                                     ->get(['attendances.employee_id','first_name', 'last_name', 'age', 'district', 'logged_in','position', 'sex', 'school']);
                    
        $conducted_training = PDF::loadView('pdf.attendance', ['training_info' => $training_info, 'user_attended' => $user_attended, 'from' => $from, 'to' => $to]);
        //return $conducted_training->download('conducted-training - '.$year.'.pdf');
        return $conducted_training->stream('pdf.attendance');
    }

    public function printTrainingParticipants($training_id)
    {
        $user_attended = AttendedTraining::leftJoin('users', 'attended_trainings.employee_id', '=', 'users.employee_id')
                                        ->leftJoin('profiles', 'attended_trainings.employee_id', '=', 'profiles.employee_id')
                                         ->orderBy('users.employee_id', 'asc')
                                        ->where('training_id', $training_id)->get();


        $training_info = OfficialTraining::where('training_id', $training_id)->first(['training_title', 'start_of_conduct', 'end_of_conduct', 'venue']);
        $conduct_training = PDF::loadView('pdf.training-participant', ['user_attended' => $user_attended, 'training_info' => $training_info]);
        //return $conducted_training->download('attended-training - '.$year.'.pdf');
        return $conduct_training->stream('pdf.training-participants');
    }

    public function printEmployeeList($report_category = null, $report_position = null, $report_sex = null)
    {
        $employees = User::join('profiles', 'users.employee_id', '=', 'profiles.employee_id')
                            ->when($report_category, function($query) use ($report_category){
                                $query->where('users.category', $report_category);
                             })
                             ->when($report_position, function($query) use ($report_position){
                                $query->where('users.position', $report_position);
                             })
                            ->when($report_sex, function($query) use ($report_sex){
                                $query->where('profiles.sex', $report_sex);
                            })
                            ->where('users.status', 1)
                            ->where('users.role', 0)
                            ->get();
                    
        $employee_list = PDF::loadView('pdf.employee-list', ['employees' => $employees]);
        //return $conducted_training->download('conducted-training - '.$year.'.pdf');
        return $employee_list->stream('pdf.employee-list');
    }

}
