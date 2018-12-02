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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Showing all Users
Route::get('/allUsers','HomeController@findFriends');
//Adding friends
Route::get('/addFriend/{id}','HomeController@sendRequest');

Route::get('/request','HomeController@showincomingrequest');
//accepting request
Route::get('/accept/{id}','HomeController@acceptrequest');
//Own friend List
Route::get('/friends','HomeController@friends');
//removing request
Route::get('/requestRemove/{id}','HomeController@requestRemove');
//mutual friend list
Route::get('/mutualFriend/{id}','HomeController@mutualFriend');
