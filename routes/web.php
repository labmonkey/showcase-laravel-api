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

Route::get( '/', 'SiteController@index' );

Route::get( 'public/api', 'ApiController@actionPublicIndex' );
Route::get( 'public/api/car/{id?}', 'ApiController@actionPublicCar' );

Route::post( 'api', 'ApiController@actionIndex' )->middleware('api.key', 'api.quota');
Route::get( 'api/key', 'ApiController@actionKey' );