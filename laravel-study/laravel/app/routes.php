<?php

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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('home',function(){
    return View::make('welcom');
});

Route::get('json',function(){
   return Response::json(['name'=>'rensike','age'=>22,'lover'=>'zhangmenglei']);
});

Route::controller('rensike','App\Controllers\RensikeController');
Route::controller('user','App\Controllers\UserController');

Route::group(array('prefix'=>'hello','before'=>'visit:'.rand(1,10)),function(){
    Route::any('hello','App\Controllers\RensikeController@index');
    Route::any('index','App\Controllers\RensikeController@index');
});
