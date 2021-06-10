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
Route::get('/', 'HomeController@table');
Route::get('/predictions', 'HomeController@index');
Route::post('/results', 'HomeController@saveResults')->name('saveResults');
Route::get('/table', 'HomeController@table')->name('table');
Route::get('/results', 'HomeController@results')->name('results');
Route::get('/others', 'HomeController@others')->name('others');
Route::get('/champion', 'HomeController@champion')->name('champion');
Route::post('/save-champion', 'HomeController@saveChampion')->name('saveChampion');

Route::get('/register', 'RegistrationController@create')->name('register');
Route::post('register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/home', 'HomeController@index');
