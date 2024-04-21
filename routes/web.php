<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\AllQueryController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/login', function(){
    if (auth()->check()){
       if (auth()->user()->role == 'admin'){
        return redirect('/admin');
       }else{
        return redirect('/');
       }
    }else{
        return view('auth.login');
    }
})->name('login');
Route::put('/add-attendance', [UserHomeController::class, 'addattendance'])->name('addattendance');

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::get('/attendance', function(){
    return view('auth.add_attendance');
})->name('attendance');

Route::middleware(['auth', 'user-role:user'])->group(function(){
    Route::controller(UserHomeController::class)->group(function(){
        Route::get('/', 'userHome')->name('user');
        Route::get('/user/dashboard/profile', 'profile')->name('UserProfile');

        Route::get('/user/dashboard/my-added-training', 'myaddedtraining')->name('myaddedtraining');
        Route::get('/user/dashboard/my-attended-training', 'myattendedtraining')->name('myattendedtraining');
        Route::get('/user/dashboard/my-upcoming-training', 'myupcomingtraining')->name('myupcomingtraining');
        Route::get('/user/dashboard/my-ongoing-training', 'myongoingtraining')->name('myongoingtraining');

        Route::get('/user/dashboard/pending-training', 'mypendingtraining')->name('mypendingtraining');
        Route::get('/user/dashboard/subordinate', 'subordinate')->name('subordinate');
        Route::get('/user/dashboard/subordinate-profile/{id}', 'subordinateprofile')->name('subordinateprofile');
        Route::get('/user/dashboard/attendance', 'userattendance')->name('userattendance');
        Route::get('/user/dashboard/my-attendance/{id}', 'viewuserattendance')->name('viewuserattendance');
        Route::get('/user/dashboard/upcoming-training', 'upcomingtraining')->name('upcomingtraining');
        Route::get('/user/dashboard/view-upcoming-training/{id}', 'viewupcomingtraining')->name('viewupcomingtraining');

        Route::get('/user/dashboard/pdf-added-training/{from}/{to}/{employee_id}', 'pdfaddedtraining')->name('pdfaddedtraining');
        Route::get('/user/dashboard/pdf-attended-training/{from}/{to}/{employee_id}', 'pdfattendedtraining')->name('pdfattendedtraining');
    
        //GAD Need Assessment survey
        Route::get('/user/dashboard/gad-need-assessment', 'gadsurveyquestion')->name('gadsurveyquestion');
    });
    
    Route::controller(AllQueryController::class)->group(function(){
        Route::post('/user/add-training', 'AddTraining')->name('UserAddTraining');
        Route::delete('/user/delete-pending-training/{id}/{cop}', 'deletePendingTraining');
        Route::put('/user/dashboard/change-picture/{id}', 'changepicture')->name('userchangepicture');
        Route::put('/user/dashboard/update-certificate/{id}', 'updateCertificate')->name('updateCertificate');
        Route::put('/user/dashboard/update-pending-training/{id}', 'UpdatePendingTraining')->name('UpdatePendingTraining');
    });
    
    
});

Route::middleware(['auth', 'user-role:admin'])->group(function(){

    Route::controller(AdminHomeController::class)->group(function(){
        Route::get('/admin', 'adminHome')->name('admin');
        Route::get('/admin/dashboard/pending-account', 'pendingaccount')->name('pendingaccount');
        Route::get('/admin/dashboard/account-list', 'accountlist')->name('accountlist');
        Route::get('/admin/dashboard/administrator', 'administrator')->name('administrator');
        Route::get('/admin/dashboard/create-training', 'createtraining')->name('createtraining');
        Route::get('/admin/dashboard/conducted-training', 'conductedtraining')->name('conductedtraining');
        Route::get('/admin/dashboard/gad-report', 'gadreport')->name('gadreport');
        Route::get('/admin/dashboard/pending-training', 'pendingtraining')->name('pendingtraining');
        Route::get('/admin/dashboard/training-list', 'traininglist')->name('traininglist');
        Route::get('/admin/dashboard/profile', 'profile')->name('profile');
        Route::get('/admin/dashboard/user-profile/{id}', 'viewuserprofile')->name('viewuserprofile');
        Route::get('/admin/dashboard/school', 'school')->name('school');
        Route::get('/admin/dashboard/positions', 'positioncategory')->name('positioncategory');
        Route::get('/admin/dashboard/attendance', 'adminattendance')->name('adminattendance');
        Route::get('/admin/dashboard/training-info/{id}', 'viewtraininginfo')->name('viewtraininginfo');
        Route::post('/admin/dashboard/otp', 'generateotp')->name('generateotp');
        Route::get('/admin/dashboard/printotp/{date}', 'printotp')->name('printotp');
        Route::post('/admin/dashboard/set-criteria/{id}', 'setcriteria')->name('setcriteria');
        Route::get('/admin/dashboard/attendance-info/{id}', 'viewattendanceinfo')->name('viewattendanceinfo');
        Route::put('/admin/dashboard/edit-training/{id}', 'adminEditTraining')->name('adminEditTraining');
        Route::get('/admin/dashboard/training-participant/{id}', 'ViewTrainingParticipant')->name('ViewTrainingParticipant');
        Route::post('/admin/dashboard/accept-pending-training', 'AcceptPendingTraining')->name('AcceptPendingTraining');

        Route::get('/admin/dashboard/print-conducted-training/{from}/{to}', 'printConductedTraining')->name('printConductedTraining');
        Route::get('/admin/dashboard/print-gad-report/{from}/{to}', 'printGADReport')->name('printGADReport');
        Route::get('/admin/dashboard/print-training-attendance/{from}/{to}/{training_id}', 'printAttendance')->name('printAttendance');
        Route::get('/admin/dashboard/print-training-participant/{training_id}', 'printTrainingParticipants')->name('printTrainingParticipants');
        Route::get('/admin/dashboard/print-employee-list/{report_category?}/{report_position?}/{report_sex?}', 'printEmployeeList')->name('printEmployeeList');
        
        //Training Category
        Route::get('/admin/dashboard/upcoming-training', 'upcomingtraining')->name('adminupcomingtraining');
        Route::get('/admin/dashboard/ongoing-training', 'ongoingtraining')->name('ongoingtraining');
        Route::get('/admin/dashboard/verify-training', 'verifytraining')->name('verifytraining');
        Route::get('/admin/dashboard/finished-training', 'finishedtraining')->name('finishedtraining');

        //GAD Need Assessment survey
        Route::get('/admin/dashboard/gad-need-assessment-choices', 'gadquestion')->name('gadquestion');
        Route::get('/admin/dashboard/gad-need-assessment-result', 'gadsurvey')->name('gadsurvey');
        });


    Route::controller(AllQueryController::class)->group(function(){
        Route::delete('/admin/dashboard/administrator/delete/{id}', 'delete_data');
        Route::put('/admin/dashboard/administrator/reject/{id}', 'reject_user')->name('reject_user');
        Route::put('/admin/dashboard/administrator/update/{id}', 'update_data')->name('updateData');
        Route::put('/admin/dashboard/administrator/accept/{id}', 'AcceptUser')->name('AcceptUser');
        Route::put('/admin/dashboard/change-picture/{id}', 'changepicture')->name('adminchangepicture');
    });
    
});

Route::middleware(['auth'])->group(function(){

    Route::controller(AllQueryController::class)->group(function(){
        Route::get('/admin/dashboard/QR', 'downloadQR')->name('downloadQR');
        Route::get('/admin/dashboard/print-selected-participants/{training_id}', 'printSelectedParticipants')->name('printSelectedParticipants');
    });
});

