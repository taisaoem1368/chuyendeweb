<?php
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//
// Authentication Routes...
$this->get('login',[
    'as' => 'login',
    'uses' =>'Auth\LoginController@showLoginForm'
]);

$this->post('login', 'Auth\LoginController@login');

$this->post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');


//home page
Route::get('/facefly',[
    'as' => 'facefly',
    'uses' => 'FlightController@index'
]);

////login
//Route::get('/login-user',[
//    'as' => 'login-watch',
//    'uses' => 'UserController@getLogin'
//]);
////login
//Route::post('/login-user',[
//    'as' => 'login-user',
//    'uses' => 'UserController@postLogin'
//]);

//register
Route::get('/register-user',[
    'as' => 'register-user',
    'uses' => 'UserController@getRegister'
]);

Route::post('/register-user',[
    'as' => 'register',
    'uses' => 'UserController@postRegister'
]);

//search page
Route::get('/search',[
    'as' => 'search',
    'uses' => 'FlightController@search'
]);
Route::get('/search',[
    'as' => 'search_return',
    'uses' => 'FlightController@search'
]);

//flight detail
Route::get('/flight-detail',[
    'as' => 'detail',
    'uses' => 'FlightController@detailFlight'
]);

//flight booking
Route::get('/flight-book',[
    'as' => 'book',
    'uses' => 'FlightController@getBooking'
]);

Route::post('/flight-book',[
    'as' => 'book',
    'uses' => 'FlightController@postBooking'
]);

//review testing page
Route::get('/review_flight-list', function(){
    return view('template.flight-list');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index');
