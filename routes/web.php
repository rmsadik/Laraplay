<?php



Route::get('/', 'ListsController@index');
Route::get('/lists', 'ListsController@index');

//members
Route::get('/lists/{listId}/members', 'MembersController@show');
Route::get('/lists/{listId}/{emailId}/edit', 'MembersController@edit');
Route::post('/lists/{listId}/{emailId}/update', 'MembersController@update');
Route::get('/lists/{listId}/create', 'MembersController@create');
Route::post('/lists/{listId}/store', 'MembersController@store');
Route::get('/lists/{listId}/{emailId}/delete', 'MembersController@destroy');
