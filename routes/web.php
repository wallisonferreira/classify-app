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
    // Route::get('/titles/watched', 'TitleController@titleMostWatched');

    Route::get('/adicionar/lista/{titulo}', 'ListController@addToList');
    Route::get('/remover/lista/{titulo}', 'ListController@removeFromList');

    Route::get('/adicionar/assistido/{titulo}', 'WatchedController@addToWatched');
    Route::get('/remover/assistido/{titulo}', 'WatchedController@removeFromWatched');
    
    Route::get('/adicionar/favorito/{titulo}', 'FavoriteController@addToFavorite');
    Route::get('/remover/favorito/{titulo}', 'FavoriteController@removeFromFavorite');

    Route::get('/lista', 'TitleController@getList');
    Route::get('/assistidos', 'TitleController@getWatched');
    Route::get('/favoritos', 'TitleController@getfavorite');

    Route::get('/ver/titulo/{titulo}', 'TitleController@getTitle');
    Route::get('/search', 'TitleController@getSearch');

    Route::get('/avaliar/{titulo}/{nota}');
    Route::get('/adicionar/comentario/{id}', 'TitleController@addComment');
    Route::get('/remover/comentario/{comment}/{user}/{titulo}', 'TitleController@removeComment');
});
