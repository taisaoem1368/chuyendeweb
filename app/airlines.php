<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class airlines extends Model {

	//
	protected $table = "airlines";
	public $primaryKey = "airline_id";
	public $timestamps = false;
	public function get_country() {
		return $this->belongsTo('App\country', 'airlines_country_id');
	}
}
