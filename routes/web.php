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

/* Route::get('/', function () {
    return view('welcome_new');
}); */

Route::get('/', 'HomeController@mainpage')->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/article/{articleid?}', 'HomeController@article')->name('article');

Route::post('/newcontent', 'HomeController@newcontent')->name('newcontent');
