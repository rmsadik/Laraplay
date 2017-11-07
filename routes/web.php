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

Route::get('/lists/{listId}/{emailId}/edit', 'ListsController@edit');
Route::post('/lists/{listId}/{emailId}/update', 'ListsController@update');
Route::get('/lists/{listId}/create', 'ListsController@create');
Route::post('/lists/{listId}/store', 'ListsController@store');

Route::get('/lists/{listId}/{emailId}/delete', 'ListsController@destroy');

// Route::get('/lists/create', 'ListsController@create');

