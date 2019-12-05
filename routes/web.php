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

Route::group(['middleware' => 'auth'], function () {

    //News routes
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@index')->name('news');
        Route::get('/create', 'NewsController@create')->name('createNews');
        Route::post('/store', 'NewsController@store')->name('storeNews');
        Route::get('/edit/{id}', 'NewsController@edit')->name('editNews');
        Route::post('/update/{id}', 'NewsController@update')->name('updateNews');
        Route::get('/delete/{id}', 'NewsController@destroy')->name('deleteNews');
    });
});
