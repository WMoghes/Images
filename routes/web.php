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
})->name('homepage');

Route::resource('/image', 'ImageController');
Route::get('/image-position', [
    'uses'          => 'ImageController@setPosition',
    'as'            => 'set.position'
]);
Route::get('/show-all', [
    'uses'          => 'ImageController@showAll',
    'as'            => 'show-all'
]);
Route::get('/crop/{id}', [
    'uses'          => 'ImageController@cropImage',
    'as'            => 'crop'
]);
Route::get('/show-all-crops/{id}', [
    'uses'          => 'ImageController@showAllCrops',
    'as'            => 'show-all-crops'
]);
