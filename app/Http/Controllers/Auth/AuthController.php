<?php namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Hash;
use Carbon\Carbon;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	public function getRegister() {
		return view('register');
	}
	public function postRegister(RegisterRequest $request) {
			$user = new User();
	        $user->name = $request->input('name');
	        $user->email = $request->input('email');
	        $user->password = Hash::make($request->password);
	        $user->phone = $request->input('phone');
	        $user->fail_login = 0;
	        $user->save();
	        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
	}
	public function getLogin() {
		return view('login');
	}

	public function postLogin(LoginRequest $request) {
		$now = Carbon::now('Asia/Ho_Chi_Minh');
		$count = User::where('email', $request->input('email'))->count();
		if($count > 0)
		{
			$user = User::where('email', $request->input('email'))->get();
			if($user[0]->fail_login < 3 || $user[0]->last_access < $now->toDateTimeString())
			{
					$user_id = $user[0]->id;
					$change = User::find($user_id);
					$auth = array('email' => $request->input('email'), 'password' => $request->input('password'));	
					if($this->auth->attempt($auth)) {
							$change->fail_login = 0;
							$change->save();
							return redirect('/');
					}
					else {
						$change->fail_login++;
						$change->last_access = $now->addMinutes(30)->toDateTimeString();
						$change->save();
						return redirect()->back()->with('message', 'Sai tài khoản hoặc mật khẩu');
					}
			}
			else
			{

				return redirect()->back()->with('message', 'Tài khoản bạn đã bị chặn vì đăng nhập sai quá 3 lần. Hãy đăng nhập lại sau 30 phút nữa.');
			}
		}
		else
		{
			return redirect()->back()->with('message', 'Email không tồn tại!');
		}
	}

}
