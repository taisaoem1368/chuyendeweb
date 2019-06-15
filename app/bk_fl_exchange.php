<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\cities;
use App\airlines;
class bk_fl_exchange extends Model {

	//
	protected $table = "fb_fl_exchange";
	public $primaryKey = "ffe_id";
	public $timestamps = false;
	public function get_bfe_fl() {
		return $this->belongsTo('App\flight_list', 'ffe_fl_id');
	}
	public function get_bfe_bk() {
		return $this->belongsTo('App\flight_booking', 'ffe_bk_id');
	}

	public function get_name_from_city_id($id) //Country and Citi and Citi_code
	{
		$city = cities::where('city_id', $id)->first();
		$country = $city->get_Country['country_name'];
		$string = $country." - ".$city['city_name']."(".$city['city_code'].") ";
		return $string;
	}

	public function get_city_name_code($id) 
	{
		$city = cities::where('city_id', $id)->first();
		return $city['city_name']." (".$city['city_code'].")";
	}

	public function get_fl_airlines_name($id)
	{
		$airline = airlines::where('airline_id', $id)->first();
		return $airline['airline_name'];
	}
	public function get_fc_name($id)
	{
		$find = flight_class::where('fc_id', $id)->first();
		return $find['fc_name'];
	}

	public function get_airport_name($id)
	{
		$find = airport::where('airport_city_id', $id)->first();
		return $find['airport_name'];
	}


}
