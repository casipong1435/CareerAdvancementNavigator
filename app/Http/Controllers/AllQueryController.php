<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profiles;
use App\Models\User;
use App\Models\SubjectArea;
use App\Models\GradeLevelTaught;
use App\Models\CareerService;
use App\Models\EducationalAttainment;
use App\Models\otp;
use App\Models\Certificates;
use App\Models\OfficialTraining;
use App\Models\AttendedTraining;
use App\Models\PendingTraining;
use App\Models\RecommendedParticipant;
use App\Models\SelectedParticipant;
use App\Models\Criteria;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use Crypt;
use PDF;

class AllQueryController extends Controller
{

    public function delete_data($id){

        $query1 = User::where('employee_id', $id);
        $query2 = Profiles::where('employee_id', $id);
        $query3 = SubjectArea::where('employee_id', $id);
        $query4 = CareerService::where('employee_id', $id);
        $query5 = EducationalAttainment::where('employee_id', $id);
        $query6 = GradeLevelTaught::where('employee_id', $id);
        if(($query1->delete() && $query2->delete()) || ($query3->delete() && $query4->delete() && $query5->delete() && $query6->delete())){
            return response()->json(['status' => true, 'row' => 'employee-data-'.$id]);
        }
    }

    public function changepicture(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'image' => 'required|max:2048'
        ]);

        $folderPath = public_path().'/assets/images/';

        $img_path = public_path().'/assets/images/'.$request->old_image;
        
        if (!is_null($request->old_image)){
            unlink($img_path);
        }

        $fileName = time().'.'.$request->image->getClientOriginalExtension();

        $values = [
            'image' => $fileName,
        ];

        $query = Profiles::where('employee_id', $id)->update($values);
        if ($query){
            $request->image->move($folderPath, $fileName);
            return response()->json(['status'=>true, 'msg'=>'Profile Changed!']);
        }
        
    }

    public function downloadQR()
    {
        $qrcode = PDF::loadView('pdf.qrcode');
        return $qrcode->download('TrainingQR.pdf');
    }

    public function printSelectedParticipants($training_id)
    {
        $selected_participants = SelectedParticipant::leftJoin('profiles', 'selected_participants.employee_id', 'profiles.employee_id')
                        ->orderBy('first_name', 'asc')
                        ->where('selected_participants.training_id', $training_id)
                        ->get();

        $training_info = OfficialTraining::where('training_id', $training_id)->first(['training_title', 'start_of_conduct', 'end_of_conduct', 'venue']);
        $selected_participant = PDF::loadView('pdf.selected-participants', ['selected_participants' => $selected_participants, 'training_info' => $training_info]);
        //return $conducted_training->download('attended-training - '.$year.'.pdf');
        return $selected_participant->stream('pdf.selected-participants');
    }

    
}
