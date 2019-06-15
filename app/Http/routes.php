<?php
use App\DSDiaDiemModel;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//==> Doi thoi gian va tinh gia ve
Route::get('/change-time/{id}', ['as' => 'changeTime', 'uses' => 'CitisController@changeTime']);

//===>Admin
Route::get('/dashboard', 'CitisController@adminIndex');
Route::get('/charts', 'CitisController@charts');
Route::group(['prefix' => 'admin'], function() {

	/*Load table airlines*/  Route::get('/airline-table/{id}', 'CitisController@getAirLineFormCountryId');
	/*Load list cities*/     Route::get('/cities-list/{id}', 'CitisController@citiesFunction');
	/*Load table airports*/  Route::get('/table-airports/{id}', 'CitisController@tableAirports');
	/*Load table booking*/   Route::get('/booking', 'CitisController@tableBooking');
	/*Search booking form sdt or email*/ Route::get('/booking-search/{key}', 'CitisController@searchBooking');
	/*Load booking*/		 Route::get('/load-booking', 'CitisController@loadBooking');
	/*Delete flight*/		 Route::get('delete/{id}', ['as'=> 'deletebk', 'uses' => 'CitisController@deleteBooking']);

	Route::group(['prefix' => 'booking'], function() {
/*Booking details passenger*/Route::get('/passenger-details/{id}', [ 'as' => 'details', 'uses' => 'CitisController@detailBooking']);
/*Edit person- get*/ 		 Route::get('/passenger-details/edit/{id}', ['as' => 'getEditPassenger', 'uses' => 'CitisController@getEditPassenger']);
/*Edit person- post*/     Route::post('/passenger-details/edit/{id}', ['as' => 'postEditPassenger', 'uses' => 'CitisController@postEditPassenger']);
		/*Delete person*/    Route::post('/passenger-details', ['as' => 'deletePassenger', 'uses' => 'CitisController@deletePassenger']);
		

	});
	//=> Route Add Flight
	Route::get('/find-airline', 'WelcomeController@findAirline');
	Route::get('/find-airport/{type}/airline/{id}', 'WelcomeController@findAirport');
	Route::post('/add-new-flight', [ 'as' => 'add-new-flight', 'uses' => 'WelcomeController@addNewFlight']);
	//Route Doanh Thu
	Route::get('/charts-airlines', 'WelcomeController@chartsControl');
	//======================================================================================
	Route::resource('citis', 'CitisController');
	//Route::get('country/{id}', 'CitisController@country');
	Route::get('country-city/{id}', 'CitisController@countryCity');
	Route::get('airline/{id}', 'CitisController@airline');
	Route::get('city/{id}', 'CitisController@city');
	Route::get('/{id?}', 'CitisController@adminIndex');
	Route::post('/add-connect/id1/{id1}/id2/{id2}', 'WelcomeController@addConnect');
	//Route::get('airport/{id}', 'airport@CitisController');
});



//===================>Search- Flights
Route::get('/connect-flight/{id}', 'UserController@connectFlightFormChange');
Route::get('/flight-detail', ['as' => 'xemChiTiet', 'uses' => 'UserController@xemChiTiet']);

Route::get('/search-flights', ['as' => 'timChuyenBay', 'uses' => 'UserController@timChuyenBay']);

Route::get('/flight-book', ['as' => 'Booking', 'middleware' => 'checkAuth', 'uses' => 'UserController@booking']);
Route::post('/continue-to-booking', ['as' => 'datVe', 'middleware' => 'checkAuth', 'uses' => 'UserController@datve']);

//==================> User
Route::get('/update-information-user',['as' => 'update-user', 'middleware' => 'checkAuth', 'uses' => 'UserController@getUpdateUser']);
Route::post('/update-information-user/{id}', ['as' => 'update-user', 'uses' => 'UserController@postUpdateUser']);
Route::post('/quenpass', ['as' => 'verify', 'uses' => 'UserController@verify']);
Route::get('/verify/token/{id}', ['as' => 'laylaipass', 'uses' => 'UserController@getLaylaipass']);
Route::post('/verify/token/{id}', ['as' => 'laylaipass', 'uses' => 'UserController@postLaylaipass']);
Route::get('/verify', function(){ $dsdiadiem = DSDiaDiemModel::all(); return view('index', ['dsdiadiem' => $dsdiadiem]);});
//=======================================================================
Route::get('/register', ['as' => 'getRegister', 'uses' =>'Auth\AuthController@getRegister']);
Route::post('/register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('/login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('/{id?}', 'UserController@index');