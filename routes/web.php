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

Route::namespace('Web')->group(function() {
    Route::get('/home', function() {
        return redirect()->home();
    });

    Route::get('/', 'HomeController@index')->name('home');
});
