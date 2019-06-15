<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\country;
use App\airlines;
use App\cities;
use App\airport;
use Illuminate\Http\Request;
use App\flight_booking;
use App\User;
use App\passengers;
use App\bk_fl_exchange;

class CitisController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$country = country::all();
		return view('flight-in-city',['country' => $country]);
	}

	//==>Function Admin Page
	public function getAirLineFormCountryId($id)
	{

		$airlines = airlines::where('airlines_country_id', $id)->get();
		return view('admin.airline-table', ['airlines' => $airlines]);
	}

	public function citiesFunction($id)
	{
		$cities_list = cities::where('cities_country_id', $id)->get();
		return view('admin.list-cities', ['cities_list' => $cities_list]);
	}


	public function countryCity($id)
	{
		$cities = cities::where('cities_country_id', $id)->get();
		return view('list-cities', ['cities' => $cities]);
	}

	public function tableAirports($id)
	{
		$airports = airport::where('airport_city_id', $id)->get();
		return view('admin.airport-table', ['airports' => $airports]);
	}
	//=>End Admin Page

	public function country($id)
	{

		$airlines = airlines::where('airlines_country_id', $id)->get();
		return view('list-airlines', ['airlines' => $airlines]);
	}

	public function airline($id)
	{
		$airline_ctr_id = airlines::select('airlines_country_id')->where('airline_id', $id)->get();
		$cities = cities::where('cities_country_id', $airline_ctr_id)->get();
		return view('list-cities', ['cities_list' => $cities]);
	}
	public function city($id)
	{
		$airports = airport::where('airport_city_id', $id)->get();
		return view('list-airport', ['airports' => $airports]);
	}
	public function adminIndex($id = 'list-booking')
	{
		$tableBooking = flight_booking::where('fb_action', '<>', 2)->get();
		return view('admin/'.$id, ['tableBooking' => $tableBooking]);
	}
	public function charts()
	{
		return view('admin.charts');
	}

	//=> Booking
	public function tableBooking()
	{
		$tableBooking = flight_booking::where('fb_action', '<>', 2)->get();
		return view('admin.list-booking', ['tableBooking' => $tableBooking]);
	}

	public function loadBooking()
	{
		$tableBooking = flight_booking::all();
		return view('admin.booking-result', ['result' => $tableBooking]);
	}

	public function searchBooking($key)
	{
		if($key == "6868a")
		{
			$error_ne = "Không tìm thấy user";

			return view('admin.booking-result')->with('error_ne', $error_ne);
		}
		
		$find_user = User::select('id')->where('email', $key)->orWhere('phone', $key)->first();
		if(count($find_user) < 1)
		{
			$error[0] = "Không tìm thấy user";
			return view('admin.booking-result', compact('error'));
		}

		$result = flight_booking::where('fb_users_id', $find_user['id'])->get();

		return view('admin.booking-result', compact('result'));
	}

	public function detailBooking($id)
	{
		$action = flight_booking::where('fb_id', $id)->first();
		$passengers = passengers::where('passenger_bk_id', $id)->where('passenger_action', '<>', 1)->get();
		$bk_fl_connect = bk_fl_exchange::where('ffe_bk_id', $id)->orderBy('ffe_fl_id', 'ASC')->get();
		return view('admin.table-passenger', compact('passengers', 'bk_fl_connect', 'action'));
	}

	public function deleteBooking($id)
	{

		$findBK = flight_booking::where('fb_id', $id)->first();
		$findBK->fb_action = 2;
		$findBK->save();
		return redirect()->back();
	}

	//==> Passenger function   
	public function getEditPassenger($id)
	{
		$person = passengers::where('passenger_id', $id)->first();;
		return view('admin.update-passenger', compact('person'));
	}

	public function postEditPassenger(Request $req, $id)
	{
		$person = passengers::where('passenger_id', $id)->first();
		$person->passenger_title = $req->title;
		$person->passenger_first_name = $req->fname;
		$person->passenger_last_name = $req->lname;
		$person->save();
		return redirect()->back()->with('success', 'success');
	}

	public function deletePassenger(Request $req)
	{
		$id = $req->input('passenger-id');
		$person = passengers::where('passenger_id', $id)->first();
		$person->passenger_action = 1;
		$person->save();
		return redirect()->back();
	}
	//=> End passenger

	//=> Change Time
	public function changeTime($id)
	{
		$day = substr($id,0,2);
		$month = substr($id, 3, 2);
		$year = substr($id, 6,4);
		$h = substr($id, 11,2);
		$i = substr($id, 14,2);
		$s = substr($id, 17,2);
		$full = date($year."/".$month."/".$day." ".$h.":".$i.":".$s);

		return view('test-time', ['data' => $full]);
	}
}
