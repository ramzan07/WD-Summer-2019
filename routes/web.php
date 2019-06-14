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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/{channel_id?}', 'FeedController@index')->name('home');
Route::get('feed/refresh', 'FeedController@refresh')->name('refreshFeed');
Route::get('feed/post/{id}', 'FeedController@show')->name('postDetails');
