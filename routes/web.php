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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/lists', 'ListsController@index');
Route::get('/lists/{listId}/members', 'ListsController@show');

Route::get('/lists/{listId}/{memberId}/edit', 'ListsController@edit');
Route::get('/lists/create', 'ListsController@create');

