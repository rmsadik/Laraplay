<?php



Route::get('/', 'ListsController@index');
Route::get('/lists', 'ListsController@index');
Route::get('/lists/{listId}/members', 'ListsController@show');

Route::get('/lists/{listId}/{emailId}/edit', 'ListsController@edit');
Route::post('/lists/{listId}/{emailId}/update', 'ListsController@update');
Route::get('/lists/{listId}/create', 'ListsController@create');
Route::post('/lists/{listId}/store', 'ListsController@store');

Route::get('/lists/{listId}/{emailId}/delete', 'ListsController@destroy');
