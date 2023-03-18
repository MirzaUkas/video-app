<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', 'App\Http\Controllers\VideoController@getVideoUploadForm')->name('videos.get');
Route::get('/videos/{path}', 'App\Http\Controllers\VideoController@playVideo')->name('videos.play');
Route::post('/videos/store', 'App\Http\Controllers\VideoController@uploadVideo')->name('videos.store');
Route::any('/videos/destroy/{id}', 'App\Http\Controllers\VideoController@destroy')->name('videos.destroy');
Route::any('/videos/edit/{id}', 'App\Http\Controllers\VideoController@edit')->name('videos.edit');
Route::any('/videos/update/{id}', 'App\Http\Controllers\VideoController@update')->name('videos.update');

