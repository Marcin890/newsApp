<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'FrontendController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'BackendController@index')->name('adminHome');

    Route::post('/saveBoard', 'BackendController@saveBoard')->name('saveBoard');

    Route::post('/saveWebsite', 'BackendController@saveWebsite')->name('saveWebsite');

    Route::get('/board' . '/{id}', 'BackendController@board')->name('board');
    Route::get('/getBoardNews' . '/{id}', 'BackendController@getBoardNews')->name('getBoardNews');

    Route::get('/showBoardNews' . '/{id}', 'BackendController@showBoardNews')->name('showBoardNews');

    Route::get('/readNews' . '/{id}', 'BackendController@readNews')->name('readNews');
});

Auth::routes();