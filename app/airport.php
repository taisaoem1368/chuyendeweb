<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\country;

class airport extends Model {

	//
	protected $table = "airport";
	public $primaryKey = "airport_id";
	public $timestamps = false;
	public function get_cities() {
		return $this->belongsTo('App\cities', 'airport_city_id');
	}

	public function get_Country_name($id)
	{
		$ctr = country::where('country_id', $id)->first();
		$name = $ctr['country_name'];
		return $name;
	}

}
