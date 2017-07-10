<?php

Auth::routes();

Route::get('/', 'HomeController@index');


Route::group(['prefix' => 'users'], function() {
   Route::get('/', 'UserController@index');
   Route::get('/{user}', 'UserController@show');

   Route::group(['middleware' => 'auth'], function() {
       Route::get('/update/{user}', 'UserController@update');
       Route::post('/update/{user}', 'UserController@update');
       Route::post('/delete/{user}', 'UserController@delete');
   });

});

