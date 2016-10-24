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
    return view('welcome');
});

Route::get('chenee/{id}',function($id){
  return "hahah".$id;
});

//Route::get('info','CheneeController@info');
Route::get('info/{id}',['uses'=>'CheneeController@info']);

//CRUD
Route::get('user/select','zlController@select');
Route::get('user/insert','zlController@insert');
Route::get('user/update','zlController@update');
Route::get('user/delete','zlController@delete');
