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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/titles/watched', 'TitleController@titleMostWatched');

    Route::get('/adicionar/lista/{titulo}', 'TitleController@addToList');
    Route::get('/remover/lista/{titulo}', 'TitleController@removeFromList');

    Route::get('/favoritos', 'TitleController@getList');

    Route::get('/adicionar/assistido/{titulo}', 'TitleController@addToWatched');
    Route::get('/remover/assistido/{titulo}', 'TitleController@removeFromWatched');

    Route::get('/assistidos', 'TitleController@getWatched');
});
