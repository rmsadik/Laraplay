<?php


//List
Route::get('/', 'ListsController@index');

Route::prefix('lists')->group(function () {

    Route::get('/', 'ListsController@index');
    Route::post('/index', 'ListsController@index');
    Route::get('/create', 'ListsController@create');
    Route::get('/{listId}/edit', 'ListsController@edit');
    Route::post('/{listId}/update', 'ListsController@update');
    Route::get('/{listId}/delete', 'ListsController@destroy');
    Route::post('/store', 'ListsController@store');
    Route::get('/logout', 'ListsController@logout');

    //members
    Route::prefix('{listId}')->group(function () {
        Route::get('/members', 'MembersController@show');
        Route::get('/{emailId}/edit', 'MembersController@edit');
        Route::post('/{emailId}/update', 'MembersController@update');
        Route::get('/create', 'MembersController@create');
        Route::post('/store', 'MembersController@store');
        Route::get('/{emailId}/delete', 'MembersController@destroy');
    });

});