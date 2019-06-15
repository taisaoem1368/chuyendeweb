<?php namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DSDiaDiemModel;
use App\airlines;
use App\connect_flight;
use App\cities;
use App\flight_list;
use App\flight_booking;
use DB;
use App\Quotation;
use Illuminate\Support\Str;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index($id = 'index')
	{
		$dsdiadiem = DSDiaDiemModel::all();
		dd($dsdiadiem);
		return view('index', ['dsdiadiem' => $dsdiadiem]);
	}

	public function findAirline()
	{
		$kq = airlines::all();

		return view('admin.find-airline', ['kqFlight' => $kq]);
	}

	public function findAirport($type, $id)
	{	
		//
		$kieu = $type;
		//Nội địa
		$airline = airlines::where('airline_id', $id)->first();


		//Lấy id đất nước đi và đất nước đến
		$country_select_id = $airline['airlines_country_id'];

		//Tìm quốc gia connect vs country_select_id
		$country_connect_left = connect_flight::where('cf_country_id1', $country_select_id)->get();

		$country_connect_right = connect_flight::where('cf_country_id2', $country_select_id)->get();

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
		$cities_country_select = cities::where('cities_country_id', $country_select_id)->get();
		//return list cities connect + cities of country selected
		return view('admin.find-airport', compact('cities_connect', 'cities_country_select', 'kieu'));

	}

	public function addNewFlight(Request $req) 
	{

		$fl_airline_id = $req->airline_id;
		$fl_departure_date = $req->departuretime;
		$fl_landing_date = $req->landingtime;
		$fl_city_id_from = $req->city_from_id;
		$fl_city_id_to = $req->city_to_id;
		$fl_cost = $req->cost;
		$fl_seat = $req->seat;

		$new_flight = new flight_list();
		$new_flight->fl_airline_id = $fl_airline_id;
		$new_flight->fl_departure_date = $fl_departure_date;
		$new_flight->fl_landing_date = $fl_landing_date;
		$new_flight->fl_city_id_from = $fl_city_id_from;
		$new_flight->fl_city_id_to = $fl_city_id_to;
		$new_flight->fl_cost = $fl_cost;
		$new_flight->fl_seat = $fl_seat;
		$new_flight->save();
		return redirect()->back()->with('addSuccessfully', 'ok');


	}

	public function addConnect(Request $req)
	{

	}

	public function chartsControl()
	{
		//$user_info = flight_booking::groupBy('fb_city_id_from')->select('fb_city_id_from', DB::raw('count(*) as total'))->get();
		//SELECT COUNT(*) as '123'FROM flight_booking GROUP BY fb_city_id_from HAVING COUNT(*) > 1
		//$user_info = Usermeta::groupBy('browser')->select('browser', DB::raw('count(*) as total'))->get();
		$from = DB::table('flight_booking')
                     ->select(DB::raw('count(*) as uscount, fb_city_id_from'))
                     ->where('fb_action', '=', 1)
                     ->groupBy('fb_city_id_from')
                     ->orderBy('uscount', 'DESC')
                     ->first();
		$to = DB::table('flight_booking')
                     ->select(DB::raw('count(*) as uscount, fb_city_id_to'))
                     ->where('fb_action', '=', 1)
                     ->groupBy('fb_city_id_to')
                     ->orderBy('uscount', 'DESC')
                     ->first();

 		if($from != null)
 		{
        	$name_from = cities::select('city_name')->where('city_id', $from->fb_city_id_from)->first();
        }
        else 
        {
        	$name_from['city_name'] = "";
        }
        if($to == null)
        {
        	$name_to['city_name'] = "";
        }
        else 
        {
        	$name_to = cities::select('city_name')->where('city_id', $to->fb_city_id_to)->first();
        }

		//$count = flight_booking::where('')
		return view('admin.chart-airline', compact('name_from', 'name_to'));
	}

}
