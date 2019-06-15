<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model {

	//
	protected $table = "country";
	public $primaryKey = "country_id";
	public $timestamps = false;
}
