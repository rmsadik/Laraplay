<?php


//List
Route::get('/', 'ListsController@index');
Route::get('/lists', 'ListsController@index');
Route::post('/lists/index', 'ListsController@index');
Route::get('/lists/create', 'ListsController@create');
Route::get('/lists/{listId}/edit', 'ListsController@edit');
Route::post('/lists/{listId}/update', 'ListsController@update');
Route::get('/lists/{listId}/delete', 'ListsController@destroy');
Route::post('/lists/store', 'ListsController@store');
Route::get('/lists/logout', 'ListsController@logout');


//members
Route::get('/lists/{listId}/members', 'MembersController@show');
Route::get('/lists/{listId}/{emailId}/edit', 'MembersController@edit');
Route::post('/lists/{listId}/{emailId}/update', 'MembersController@update');
Route::get('/lists/{listId}/create', 'MembersController@create');
Route::post('/lists/{listId}/store', 'MembersController@store');
Route::get('/lists/{listId}/{emailId}/delete', 'MembersController@destroy');
