<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $request->validate([
            "employee_id" => 'required',
            "password" => 'required'
       ]);

       $credentials = $request->only('employee_id', 'password');

       if(auth()->attempt($credentials)){
            
        return (auth()->user()->role == 'admin') ? redirect('/admin') : redirect('/');
            
       }

       return redirect('login')->with('failed', "Emloyee ID or Password is Incorrect!");
    }

    public function logout(){

        Session::flush();
        Auth::logout();
        Session::regenerateToken();

        return redirect('login');
    }
}
