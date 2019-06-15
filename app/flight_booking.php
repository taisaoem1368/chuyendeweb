<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\flight_class;
class flight_booking extends Model {

	//
	protected $table = "flight_booking";
	public $primaryKey = "fb_id";
	public $timestamps = false;

	public function get_fb_city_from() {
		return $this->belongsTo('App\cities', 'fb_city_id_from');
	}
	public function get_fb_city_to() {
		return $this->belongsTo('App\cities', 'fb_city_id_to');
	}
	public function get_fb_user()
	{
		return $this->belongsTo('App\User', 'fb_users_id');
	}
	public function get_fl_class_name($id)
	{
		// $find = flight_class::where('fc_id', $id);
		// return $find['fc_name'];
		return $this->belongsTo('App\flight_class', 'fb_type');
	}
}
