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


Route::get('/{channel_id?}', 'FeedController@index')->name('home');

Route::get('feed/refresh', 'FeedController@refresh')->name('refreshFeed');

Route::get('feed/post/{id}', 'FeedController@show')->name('postDetails');

Route::get('get/providers', 'ChannelController@index')->name('getProviders');

Route::get('channel/add', 'ChannelController@create')->name('createChannel');

Route::post('channel/store', 'ChannelController@store')->name('storeChannel');

/* My Routes*/

Route::put('provider/update', 'ChannelController@updateProvider')->name('updateProvider');
Route::get('provider/details', 'ChannelController@viewProvider')->name('detailsProvider');
