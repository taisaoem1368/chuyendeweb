<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Models\User;
use Hash;


class UserController extends Controller{
    
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
   
    public function getLogin(){
        return view('template.login');
    }
    
    public function getRegister(){
           
        return view('template.register');
    }
    
    protected function updateLogin($emailLogin){
        $user_obj = new User();
        $user_login = $user_obj->where('email',$emailLogin)->get();
        //update last login
        $user_login->user_last_active = date('Y-m-d H:i:s');
        $user_login->save();
    }


    protected function updateFallen($emailFallen){
        $user_obj = new User();
        $user_fallen = $user_obj->where('email',$emailFallen)->get();
        //update tempt
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $user_last_active = strtotime($user_fallen->user_last_active);
        
        if (($current_time-$user_last_active) < 1800)
        { $active_duration = true;}
        else
        { $active_duration = false;}
        
        if ($user_fallen->user_active != 'deactive')
        {
            if ($user_fallen->user_tempt <3)
            {
                
                $user_fallen->user_tempt +=1;
                $emailLogin = $user_fallen->email;
                updateLogin($emailLogin);
            }
            elseif ($user_fallen->user_tempt == 3)
            {
                $emailLogin = $user_fallen->email;
                updateLogin($emailLogin);
                $user_fallen->user_tempt = 0;
                $user_fallen->user_active = 'deactive';
            }
        }
        else
        {
            if ($active_duration)
            {
                $user_fallen->user_active = 'active';
            }
            return false;
        }
        $user_fallen->save();
        return true;
    }
    
    public function Login(Request $req){
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
//            $name = Auth::User()->name;
//            return redirect()->back()->with(['flag'=>"success",'message'=>"Login Successfully!".$name]);
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
    
    public function postRegister(Request $req){
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
        
        $user_obj = new User();
        $user_obj->email = $req->user_email;
        $user_obj->password = Hash::make($req->user_pass);
        $user_obj->name = $req->user_name;
        $user_obj->user_phone = $req->user_phone;
        $user_obj->save();
        
        return redirect()->back()->with(['flag'=>"success",'message'=>"Sign up Successfully!"]);;
    }
    
    
    
}
