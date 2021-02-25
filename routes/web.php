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

    Route::get('/showUsersOffBoard' . '/{id}', 'BoardController@showUsersOffBoard')->name('showUsersOffBoard');



    // Websites

    Route::post('/saveWebsite' . '/{website_id?}', 'WebsiteController@create')->name('saveWebsite');

    Route::get('/deleteWebsite' . '/{id}', 'WebsiteController@destroy')->name('deleteWebsite');

    Route::get('/addWebsite' . '/{board_id}', 'WebsiteController@addWebsite')->name('addWebsite');

    Route::get('/editWebsite' . '/{id}', 'WebsiteController@edit')->name('editWebsite');

    Route::post('/updateWebsite', 'WebsiteController@update')->name('updateWebsite');

    // News
    Route::get('/refreshBoardNews' . '/{id}', 'NewsController@refreshBoardNews')->name('refreshBoardNews');

    Route::get('/refreshAllBoardNews', 'NewsController@refreshAllBoardNews')->name('refreshAllBoardNews');

    Route::get('/showBoardNews' . '/{id}', 'NewsController@showBoardNews')->name('showBoardNews');


    Route::get('/readNews' . '/{id}', 'NewsController@readNews')->name('readNews');

    Route::get('/articleNews' . '/{id}', 'NewsController@articleNews')->name('articleNews');

    Route::get('/showUserArticles', 'NewsController@showUserArticles')->name('showUserArticles');

    // User
    Route::post('/addUserToBoard', 'BoardController@addUserToBoard')->name('addUserToBoard');

    Route::post('/removeUserFromBoard', 'BoardController@removeUserFromBoard')->name('removeUserFromBoard');
});

Auth::routes();