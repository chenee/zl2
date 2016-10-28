<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('main');
});


//mysql CRUD
Route::get('user/select','zlController@select');
Route::get('user/insert','zlController@insert');
Route::get('user/update','zlController@update');
Route::get('user/delete','zlController@delete');

//services
Route::get('services','servicesController@main');
Route::get('services/new','servicesController@new');
Route::get('services/electronic','servicesController@electronic');
Route::post('services/electronic','servicesController@new_electronic');

//register
Route::get('register/normal','registerController@normal');
Route::post('register/normal','registerController@new_normal');

Route::get('register/vip','registerController@vip');
Route::post('register/vip','registerController@new_vip');

Route::get('editprofile','registerController@profile');
Route::post('editprofile','registerController@new_profile');

//project list
Route::get('projectlist','projectlistController@show');
Route::get('projectlist/{id}','projectlistController@detail');

Route::post('detail/communication','projectlistController@new_detail');

//wx
Route::get('wx','wxController@getinfo');
Route::get('wxinfo','wxController@wxinfo');


