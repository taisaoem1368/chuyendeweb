<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Models\User;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function showLoginForm(){
        return view('template.login');
    }
    
    public function login(Request $req){
//        $this->validate($req,
//            [
//                'user_email'=>'required|unique:user,user_email',
//                'user_password' => 'required|min:6'
//            ],
//            [
//                'user_email.required' => 'Vui long nhap email',
//                'user_email.email' => 'Vui long nhap dung dinh dang email',
//                'user_password.required' => 'Vui long nhap mat khau',
//                'user_password.min' => 'Password phai lon hon 6 ky tu'
//            ]);
        
        //bien chung thuc
        $credentials = ['email' => $req->user_email,'password' => $req->user_password];
//        var_dump($credentials);
//        die();
        
             
        if (Auth::attempt($credentials)){
//            var_dump(Auth::check());
//            var_dump(Auth::User()->name);die();
            
            $name = Auth::User()->name;
            return redirect()->back()->with(['flag'=>"success",'message'=>"Login Successfully!"]);
            
//            return redirect()->back()->with(['flag'=>"success",'message'=>"Login Successfully!"]);
//            return redirect()->intended('facefly');
        }
        else{
//            $emailFallen = $req->user_email;
//            if ($this->updateFallen($emailFallen))
//            {
//                return redirect()->back()->with(['flag'=>"danger",'message'=>"Login Failed! Check your email/password"]);
//            }
//            else
//            {
                return redirect()->back()->with(['flag'=>"danger",'message'=>"Login Failed Many Times! Your account has been PROTECTED for 30mins! Please try again later!"]);
//            }
        }
        
    }
}
