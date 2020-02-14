<?php

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

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('get-incidents', 'IncidentController@getIncidents')->name('getIncidents');
Route::post('refresh-incidents', 'IncidentController@refreshIncidents')->name('refreshIncidents');
Route::post('get-arrivals', 'ArrivalController@getArrivals')->name('getArrivals');
Route::post('get-single-arrival', 'ArrivalController@getSingleArrival')->name('getArrivals');
Route::post('refresh-arrival', 'ArrivalController@refreshArrival')->name('refreshArrival');
