<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cities extends Model {

	//
	protected $table = "cities";
	public $primaryKey = "city_id";
	public $timestamps = false;
	public function get_Country() {
		return $this->belongsTo('App\country', 'cities_country_id');
	}
	public function get_Airport() {
		return $this->belongsTo('App\airport', 'cities_airport_id');
	}

}
