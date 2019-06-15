<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\cities;
use App\country;
use App\connect_flight;
use Session;
class DataProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('*', function($view){
			$country = country::all();
			return $view->with('country_list', $country);
		});

		view()->composer('*', function($view){

			//noi dia
			$cities = cities::all();
			return $view->with('cities', $cities);
		});

		// view()->composer('*', function($view){
		// 	$country_now_id = 1;
		// 	//xuyen quoc gia
		// 	$country_connect_left = connect_flight::where('cf_country_id1', $country_now_id)->get();

		// 	$country_connect_right = connect_flight::where('cf_country_id2', $country_now_id)->get();


		// 	for($i = 0; $i < count($country_connect_right); $i++)
		// 	{
		// 		$data_right[$i] = $country_connect_right[$i]['cf_country_id1'];
		// 	}
		// 	for($i = 0; $i < count($country_connect_left); $i++)
		// 	{
		// 		$data_left[$i] = $country_connect_left[$i]['cf_country_id2'];
		// 	}

		// 	$cities_connect = cities::whereIn('cities_country_id', $data_left)->orWhereIn('cities_country_id', $data_right)->get();
		// 	return $view->with('cities_connect', $cities_connect);
		// });

		view()->composer(['flight-book', 'flight-list', 'flight-detail'], function($view) {	
			if(Session::has('booking_choose'))
			{
				$booking_choose = Session::get('booking_choose');
				return $view->with(['booking_choose' => $booking_choose]);
			}
		});
	}


	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
