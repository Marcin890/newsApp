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

    // Boards
    Route::get('/', 'BoardController@index')->name('boardIndex');

    Route::post('/createBoard', 'BoardController@create')->name('createBoard');

    Route::get('/destroyBoard'  . '/{id}', 'BoardController@destroy')->name('destroyBoard');

    Route::get('/showBoard' . '/{id}', 'BoardController@show')->name('showBoard');



    // Websites

    Route::post('/saveWebsite', 'WebsiteController@create')->name('saveWebsite');

    Route::get('/deleteWebsite' . '/{id}', 'WebsiteController@destroy')->name('deleteWebsite');

    // News
    Route::get('/getBoardNews' . '/{id}', 'NewsController@getBoardNews')->name('getBoardNews');

    Route::get('/showBoardNews' . '/{id}', 'NewsController@showBoardNews')->name('showBoardNews');


    Route::get('/readNews' . '/{id}', 'NewsController@readNews')->name('readNews');

    Route::get('/articleNews' . '/{id}', 'NewsController@articleNews')->name('articleNews');

    Route::get('/showUserArticles', 'NewsController@showUserArticles')->name('showUserArticles');

    // User
    Route::post('/addUserToBoard', 'BoardController@addUserToBoard')->name('addUserToBoard');
});

Auth::routes();