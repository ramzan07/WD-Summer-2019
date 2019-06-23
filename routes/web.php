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


Route::get('/{channel_id?}', 'RssController@index')->name('home');

Route::get('feed/refresh', 'RssController@refresh')->name('refreshFeed');

Route::get('feed/post/{id}', 'RssController@show')->name('postDetails');

Route::get('get/providers', 'ProviderController@index')->name('getProviders');

/* My Routes*/

Route::put('provider/update', 'ProviderController@updateProvider')->name('updateProvider');
Route::get('provider/details', 'ProviderController@viewProvider')->name('detailsProvider');
