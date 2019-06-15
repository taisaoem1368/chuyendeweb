<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DSDiaDiemModel;
use Illuminate\Http\Request;
use Hash;
use App\airlines;
use App\cities;
use App\flight_booking;
use App\flight_class;
use App\flight_list;
use App\passengers;
use App\User;
use Auth;
use App\bk_fl_exchange;
use Session;
use App\connect_flight;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index($id = 'index')
	{		
		return view($id);
	}

	public function verify(Request $request) {
		$email = $request->email;
		$count = User::where('email', '=', $email)->count();
		if($count > 0)
		{
			$find = User::where('email', '=', $email)->get();
			echo "http://localhost:82/flight/public/verify/token/".$find[0]->remember_token;
		}
		else
		{
			return redirect()->back()->with('message', 'Email không tồn tại!');
		}
		

		

	}

	public function getLaylaipass($id)
	{
		$token = $id;
		$count = User::where('remember_token', $token)->count();
		if($count > 0)
		{
			return view('verify', ['token' => $token]);
		}
		else
		{
			echo "Mã xác nhận đã hết hạn!";
		}
	}
	public function postLaylaipass($id, Request $request)
	{
		$token = $id;
		$password = Hash::make($request->password);
		$count = User::where('remember_token', $token)->count();
		if($count > 0)
		{
			$user = User::where('remember_token', $token)->get();
			$change = User::find($user[0]->id);
			$change->password = $password;
			$change->fail_login = 0;
			
			$change->save();
			echo "đổi mật khẩu thành công!";

		}
		else
		{
			echo "đổi mật khẩu không thành công!";
		}
	}

	public function getUpdateUser()
	{
		return view('information-user');
	}

	public function postUpdateUser($id, Request $request)
	{
		$this->validate($request,
			[
				'name'=>'required',
				'phone'=>'required|numeric'
			],
			[
				'name.required'=>'Vui lòng nhập name',
				'phone.required'=>'Vui lòng nhập phone',
				'phone.numeric'=>'Số điện thoại phải là số',
			]);
		$name = $request->name;
		$phone = $request->phone;
		$user = User::find($id);
		$user->name = $name;
		$user->phone = $phone;
		$user->save();
		return redirect()->back()->with('success', 'Thay đổi thành công !');
	}

	public function timChuyenBay(Request $request) 
	{

		$this->validate($request,
			[
				'dateoneway'=>'required',
			],
			[
				'dateoneway.required'=>'vui lòng chọn ngày',
			]);

		if($request->flight_type == "return")
		{
			$this->validate($request,
				[
					'datereturn'=>'required',
				],
				[
					'dateoneway.required'=>'vui lòng chọn ngày',
				]);
		}

		$from = $request->from;
		$to = $request->to;
		$name_from = cities::where('city_id', $from)->first();
		$name_to = cities::where('city_id', $to)->first();

		$ngaydi = $request->dateoneway;
		$flight_type = $request->flight_type;
		$flight_class = $request->flight_class;
		$person_tolal = $request->person_tolal;

		$fl_id_parent = flight_list::select('fl_id')->where('fl_city_id_from', $from)->first();

		$notransit = flight_list::where('fl_city_id_from', $from)->where('fl_city_id_to', $to)->get();
		$transit = flight_list::where('fl_id_parent', $fl_id_parent['fl_id'])->get();

			//lấy id của ds chuyến bay này -> đêm qua thông tin chuyến bay kiểm tra -> nếu hàng nào có id chuyến bay + với điều kiện hạng vé thì xuất ra :)


		return view('flight-list', compact('notransit', 'name_from', 'name_to', 'transit'));
		
	}

	public function xemChiTiet(Request $request) {
		$from = $request->from;
		$to = $request->to;
		$name_from = cities::where('city_id', $from)->first();
		$name_to = cities::where('city_id', $to)->first();

		$fl_id = $request->id;

		$dateoneway = $request->dateoneway;
		$datereturn = $request->datereturn;
		
		$flight_class = $request->flight_class;
		$find = flight_list::where('fl_id', $fl_id)->get();

		if(count($find) <= 0)
		{
			echo "Hiện tại chưa có chuyến bay này!";
		}
		else 
		{
			$fl_id_parent = flight_list::select('fl_id')->where('fl_city_id_from', $from)->first();
			$transit_dt = flight_list::where('fl_id_parent', $fl_id_parent['fl_id'])->get();
			$informationDetail = $find[0];
			return view('flight-detail', compact('informationDetail', 'name_from', 'name_to', 'transit_dt'));
		}
	}

	public function booking(Request $request)
	{
		$from = $request->from;
		$to = $request->to;
		
		

		$fl_id = $request->id;
		$dateoneway = $request->dateoneway;
		$datereturn = $request->datereturn;
		$flight_class = $request->flight_class;
		$chuyen2 = null;
		$transit_2 = null;
		$name_from = cities::where('city_id', $to)->first();
		$name_to = cities::where('city_id', $from)->first();
		$ngaydi = $request->dateoneway;

		$fl_id_parent = flight_list::select('fl_id')->where('fl_city_id_from', $to)->first();
		if(isset($_GET['datereturn']))
		{

			if(Session::has('booking_choose'))
			{
				$getChoose = Session::get('booking_choose');
				//dd($getChoose[0]);
				$check = flight_list::where('fl_id', $getChoose[0])->get();
				if($from == $check[0]['fl_city_id_from'])
				{
					Session::forget('booking_choose');
					$request->session()->put('booking_choose', [$fl_id, $request->transit]);
					$notransit = flight_list::where('fl_city_id_from', $to)->where('fl_city_id_to', $from)->get();
					$transit = flight_list::where('fl_id_parent', $fl_id_parent['fl_id'])->get();
					return view('flight-list', compact('notransit', 'name_from', 'name_to', 'transit'));
				}
				else
				{

					$informationDetail = $check[0];
					$transit_dt = flight_list::where('fl_id_parent', $getChoose[0])->get();
					$info_2 = flight_list::where('fl_id', $fl_id)->first();
					
					$transit_2 = flight_list::where('fl_id_parent', $fl_id)->get();

					return view('flight-book', compact('informationDetail', 'transit_dt', 'info_2', 'transit_2'));
				}
			}
			else
			{
				$request->session()->put('booking_choose', [$fl_id, $request->transit]);
				//$departure = session::get($ssdeparture);
				
				//Session::forget('booking_choose');	

				$notransit = flight_list::where('fl_city_id_from', $to)->where('fl_city_id_to', $from)->get();
				$transit = flight_list::where('fl_id_parent', $fl_id_parent['fl_id'])->get();
				return view('flight-list', compact('notransit', 'name_from', 'name_to', 'transit'));
			}
		}
		else
		{

			$find = flight_list::where('fl_id', $fl_id)->get();
			if(count($find) <= 0)
			{
				echo "Hiện tại chưa có chuyến bay này!";
			}
			else 
			{
				$request->session()->put('booking_choose', [$fl_id, $request->transit]);
				$informationDetail = $find[0];
				$transit_dt = flight_list::where('fl_id_parent', $fl_id)->get();
				return view('flight-book', compact('informationDetail', 'transit_dt'));
			}
		}

	}

	public function datve(Request $request) {
		
		if($request->payment == "credit_card")
		{
			$this->validate($request,
				[
				'card_number'=>'required|max:11|min:11',//numeric
				'namecard'=> 'required|min:3|max:60',
				'ccv' => 'required|min:3|max:4', //numeric
			],
			[
				'card_number.required'=>'vui lòng nhập card_number',
				'card_number.min' => 'card_number có ít nhất 11 kí tự',
				'card_number.max' => 'card_number có nhiều nhất 11 kí tự',
				
				//'card_number.numeric' => 'card number phải là số',
				'namecard.required' => 'vui lòng nhập namecard',
				'namecard.min' => 'name card ít nhất 3 kí tự',
				'namecard.max' => 'name card có nhiều nhất 60 kí tự',
				'ccv.required' => 'Vui lòng nhập CCV code',
				'ccv.min' => 'CCV ít nhất 3 số',
				'ccv.max' => 'CCV nhiều nhất 4 số',
				//'ccv.numeric' => 'CCV phải là số',

			]);
		}

		$passengers_array = $request->passenger_input;
		$transit = $request->transit;
		$parent = $request->id;

		if($request->flight_type != "return")
		{
		//==>BOOKING DEPARTURE
			/*Get departure -> */ 
			$fb = new flight_booking();
			$fb->fb_city_id_from = $request->from;
			$fb->fb_city_id_to = $request->to;
			if($transit > 0)
			{	
				$transit_dt = flight_list::where('fl_id_parent', $parent)->get();
				$fb->fb_departure_date = $transit_dt[0]['fl_departure_date'];

			}
			else
			{
				$flight = flight_list::where('fl_id', $parent)->first();
				$fb->fb_departure_date = $flight['fl_departure_date'];
			}
			$fb->fb_type = $request->flight_class;
			$fb->fb_users_id = Auth::user()->id;
			if($request->payment == "credit_card")
			{
				$fb->fb_credit_card = $request->card_number;
				$fb->fb_credit_name = $request->namecard;
				$fb->fb_ccv_code = $request->ccv;
			}
			else if($request->payment == "transfer")
			{
				$fb->fb_transfer = "YES";
			}
			else
			{
				$fb->fb_paypal = "YES";	
			}
			$fb->fb_action = 0;
			$fb->save();
			if($transit > 0)
			{
				$transit_dt = flight_list::where('fl_id_parent', $parent)->get();
				for($g = 0; $g < count($transit_dt); $g++)
				{
					$ffe = new bk_fl_exchange();
					$ffe->ffe_bk_id = $fb->fb_id;
					$ffe->ffe_fl_id = $transit_dt[$g]['fl_id'];
					$ffe->save();
				}
			}
			else
			{
				$ffe = new bk_fl_exchange();
				$ffe->ffe_bk_id = $fb->fb_id;
				$ffe->ffe_fl_id = $parent;
				$ffe->save();
			}
		//=> END DEPARTURE
		} else
		{


		//=>DEPARTURE + RETURN
			$depar = Session::get('booking_choose');
			$fb = new flight_booking();
			$fl_depar = flight_list::where('fl_id', $depar[0])->first();
			$fb->fb_city_id_from = $fl_depar->fl_city_id_from;
			$fb->fb_city_id_to = $fl_depar->fl_city_id_to;
			if($depar[1] > 0)
			{	
				$transit_dt = flight_list::where('fl_id_parent', $depar[0])->get();
				$fb->fb_departure_date = $transit_dt[0]['fl_departure_date'];

			}
			else
			{
				$fb->fb_departure_date = $fl_depar['fl_departure_date'];
			}
			$fb->fb_type = $request->flight_class;
			$fb->fb_users_id = Auth::user()->id;
			if($request->payment == "credit_card")
			{
				$fb->fb_credit_card = $request->card_number;
				$fb->fb_credit_name = $request->namecard;
				$fb->fb_ccv_code = $request->ccv;
			}
			else if($request->payment == "transfer")
			{
				$fb->fb_transfer = "YES";
			}
			else
			{
				$fb->fb_paypal = "YES";	
			}
			$fb->fb_action = 0;
			$fb->save();
			if($depar[1] > 0)
			{
				$transit_dt = flight_list::where('fl_id_parent', $depar[0])->get();
				for($j = 0; $j < count($transit_dt); $j++)
				{
					$ffe = new bk_fl_exchange();
					$ffe->ffe_bk_id = $fb->fb_id;
					$ffe->ffe_fl_id = $transit_dt[$j]['fl_id'];
					$ffe->save();
				}
			}
			else
			{
				$ffe = new bk_fl_exchange();
				$ffe->ffe_bk_id = $fb->fb_id;
				$ffe->ffe_fl_id = $depar[0];
				$ffe->save();
			}

		//=>BOOKING RETURN
			if($request->flight_type == "return")
			{
				$fb_return = new flight_booking();
				$fb_return->fb_city_id_from = $request->from;
				$fb_return->fb_city_id_to = $request->to;

				if($transit > 0)
				{ 
					$transit_2 = flight_list::where('fl_id_parent', $parent)->first();
					$fb_return->fb_departure_date = $transit_2['fl_departure_date'];
				}
				else 
				{
					$flight = flight_list::where('fl_id', $parent)->first();
					$fb_return->fb_departure_date = $flight['fl_departure_date'];
				}

				$fb_return->fb_type = $request->flight_class;
				$fb_return->fb_users_id = Auth::user()->id;
				if($request->payment == "credit_card")
				{
					$fb_return->fb_credit_card = $request->card_number;
					$fb_return->fb_credit_name = $request->namecard;
					$fb_return->fb_ccv_code = $request->ccv;
				}
				else if($request->payment == "transfer")
				{
					$fb_return->fb_transfer = "YES";
				}
				else
				{
					$fb_return->fb_paypal = "YES";	
				}
				$fb_return->fb_action = 0;
				$fb_return->save();

				if($transit > 0)
				{
					$transit_2 = flight_list::where('fl_id_parent', $parent)->get();
					for($k = 0; $k < count($transit_2); $k++)
					{
						$ffe_2 = new bk_fl_exchange();
						$ffe_2->ffe_bk_id = $fb_return->fb_id;
						$ffe_2->ffe_fl_id = $transit_2[$k]['fl_id'];
						$ffe_2->save();
					}
				}
				else
				{
					$ffe_2 = new bk_fl_exchange();
					$ffe_2->ffe_bk_id = $fb_return->fb_id;
					$ffe_2->ffe_fl_id = $parent;
					$ffe_2->save();
				}
			}
		}
		//=>END RETURN
		for($i = 0; $i < count($passengers_array); $i++)
		{
			//flight-booking | flight-list | exchange
			if($request->flight_type == "return")
			{

				$passenger_2 = new passengers();
				$passenger_2->passenger_title = $passengers_array[$i]["'title'"];
				$passenger_2->passenger_first_name = $passengers_array[$i]["'firstname'"];
				$passenger_2->passenger_last_name = $passengers_array[$i]["'lastname'"];
				$passenger_2->passenger_user_id = Auth::user()->id;
				$passenger_2->passenger_bk_id = $fb_return->fb_id;
				$passenger2->passenger_action = 0;
				$passenger_2->save();
			}

			$passenger = new passengers();
			$passenger->passenger_title = $passengers_array[$i]["'title'"];
			$passenger->passenger_first_name = $passengers_array[$i]["'firstname'"];
			$passenger->passenger_last_name = $passengers_array[$i]["'lastname'"];
			$passenger->passenger_user_id = Auth::user()->id;
			$passenger->passenger_bk_id = $fb->fb_id;
			$passenger->passenger_action = 0;


			$passenger->save();

		}
		return redirect()->back()->with('success', 'ok dat ve thanh cong');
	}



	public function connectFlightFormChange($id)
	{
		$city_select = $id; //Lấy ra id thành phố khách hàng đang chọn điểm đi

		//Lấy id đất nước đi và đất nước đến từ id thành phố đi và đến
		$country_select_id = cities::select('cities_country_id')->where('city_id', $city_select)->first();


		//Tìm quốc gia connect vs country_select_id
		$country_connect_left = connect_flight::where('cf_country_id1', $country_select_id['cities_country_id'])->get();

		$country_connect_right = connect_flight::where('cf_country_id2', $country_select_id['cities_country_id'])->get();

		//get id_country has connect vs country_select_id
		if(count($country_connect_right) > 0)
		{
			for($i = 0; $i < count($country_connect_right); $i++)
			{
				$data_right[$i] = $country_connect_right[$i]['cf_country_id1'];
			}
		}
		
		if(count($country_connect_left) > 0)
		{
			for($i = 0; $i < count($country_connect_left); $i++)
			{
				$data_left[$i] = $country_connect_left[$i]['cf_country_id2'];
			}
		}


		// Nết get id_country có tồn tại sẽ bắt đầu lấy city đã connect
		if(isset($data_right) && isset($data_left))
		{
			$cities_connect = cities::whereIn('cities_country_id', $data_left)->orWhereIn('cities_country_id', $data_right)->get();
		} elseif(isset($data_right)) {
			$cities_connect = cities::WhereIn('cities_country_id', $data_right)->get();
		} elseif(isset($data_left)) {
			$cities_connect = cities::whereIn('cities_country_id', $data_left)->get();
		} else {
			$cities_connect[] = null;
		}

		//Get city of country => customer selected
		$cities_country_select = cities::where('cities_country_id', $country_select_id['cities_country_id'])->get();
		//return list cities connect + cities of country selected
		return view('list-connect', compact('cities_connect', 'cities_country_select'));
		}
}	
