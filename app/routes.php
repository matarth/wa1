	<?php

include_once('controllers/Event.php');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/','PageController@about');
Route::get('/about', 'PageController@about');
Route::get('/news', 'PageController@news');
Route::get('/gallery', 'PageController@gallery');
Route::get('/contact', 'PageController@contact');


Route::get('/calendar', 'CalendarController@show');
Route::get('/calendar/{month}/{year}', 'CalendarController@setSpecific');


Route::get('/session/create', 'SessionsController@create');
Route::post('/session/store', 'SessionsController@store');
Route::get('/session/destroy', 'SessionsController@destroy');

Route::get('/register', 'UserController@create');
Route::get('/users', 'UserController@printUsers');

Route::get('user/changepsw', array('before' => 'auth', 'as' => 'user.changePsw', 'uses' => 'UserController@changePswView'));
Route::post('user/changeUserPsw', array('as' => 'user.changeUserPsw', 'uses' => 'UserController@callChangePsw'));
Route::resource('user', 'UserController');
Route::get('user/destroy/{mm}', 'UserController@destroy');

Route::get('/pokus', 'PokusController@xyz');
Route::get('/pokus/{mm}', 'PokusController@show2');

Route::get('/event/sign/{id}', array('before' => 'auth', 'uses' => 'PokusController@signin'));
Route::get('/event/unsign/{id}', 'PokusController@unsign');

Route::get('/mail', 'PokusController@mail');

Route::get('event/{id}', function($id){
  $event = DB::table('Events')->where('id', $id)->first();
  return View::make('event', ['akce' => new Event($event, new DateTime($event->datum), true)]);
}
);

Route::get('/feedback', 'FeedbackController@show');
Route::get('uservalidate', 'PokusController@userValidate');

Route::get('root', array('before' => 'auth', 'uses' => 'UserController@rootpage'));
Route::post('root/createevent', array('before' => 'auth', 'uses' => 'RootController@createEvent'));
Route::post('root/uploadFile', array('before' => 'auth', 'uses' => 'RootController@uploadFile'));
Route::get('root/eventList', array('before' => 'auth', 'uses' => 'RootController@eventList'));
Route::get('root/userList', array('before' => 'auth', 'uses' => 'RootController@userList'));
Route::get('root/attendants/{id}', array('before' => 'auth', 'uses' => 'RootController@attendants'));
Route::get('event/destroy/{mm}', 'RootController@destroyEvent');

Route::get('/emailValidate', array('uses' => 'UserController@emailValidate')); //ajax