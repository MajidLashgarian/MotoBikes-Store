<?php

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
//Main Page Routes
Route::get('/', 'Bikes\Bikes@showAllMotoBike');
Route::get('/motobike/{id}' ,'Bikes\Bikes@ShowMotoBike');

// Authentication routes...
Route::get('admin/login', 'Auth\AuthController@canRegister');
Route::post('admin/login', 'Auth\AuthController@postLogin');
Route::get('admin/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('admin/register', 'Auth\AuthController@canRegister');
Route::post('admin/register', 'Auth\AuthController@canRegister');


//Bikes Panel Routes
Route::get('admin/register_newbike' , [ 'middleware' => 'auth', 'uses'=>'Bikes\Bikes@registerNewBike']);
Route::post('admin/register_newbike' , [ 'middleware' => 'auth', 'uses'=>'Bikes\Bikes@registerNewBike']);
Route::get('admin/allbike' , [ 'middleware' => 'auth', 'uses'=>'Bikes\Bikes@showAllMotoBike']);
Route::get('admin/motobike/{id}' , [ 'middleware' => 'auth', 'uses'=>'Bikes\Bikes@ShowMotoBike']);

//Search and Filtering
Route::get('/search' , 'Bikes\Bikes@searchBike');
