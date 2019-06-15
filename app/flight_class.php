<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class flight_class extends Model {

	//
	protected $table = "flight_class";
	public $primaryKey = "fc_id";
	public $timestamps = false;

	function get_name_fc($id) {
		$name = flight_class::select('fc_name')->where('fc_id', $id)->first();
		return $name['fc_name'];
	}
}
