<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class flight_list extends Model {

	//
	protected $table = "flight_list";
	public $primaryKey = "fl_id";
	public $timestamps = false;

	public function get_fl_airline_id() {
		return $this->belongsTo('App\airlines', 'fl_airline_id');
	}
	public function get_fl_city_id_from() {
		return $this->belongsTo('App\cities', 'fl_city_id_from');
	}
	public function get_fl_city_id_to() {
		return $this->belongsTo('App\cities', 'fl_city_id_to');
	}
	public function get_fl_fc_id() {
		return $this->belongsTo('App\flight_class', 'fl_fc_id');
	}
	public function get_fl_airport_from() {
		return $this->belongsTo('App\airport', 'fl_city_id_from', 'airport_city_id');
	}
	public function get_fl_airport_to() {
		return $this->belongsTo('App\airport', 'fl_city_id_to', 'airport_city_id');
	}

}
