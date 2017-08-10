<?php

Auth::routes();

Route::get('/', 'PostController@index');

Route::group(['prefix' => 'users'], function() {

   Route::get('/', 'UserController@index');

   Route::group(['middleware' => 'auth'], function() {
       Route::get('/{user}', 'UserController@show');
       Route::post('/create', 'UserController@create');
       Route::get('/update/{user}', 'UserController@update');
       Route::post('/update/{user}', 'UserController@update');
       Route::post('/delete/{user}', 'UserController@delete');
   });
});

Route::group(['prefix' => 'posts'], function() {

   Route::get('/', 'PostController@index');
   Route::get('/{post}', 'PostController@show');

   Route::group(['middleware' => 'auth'], function() {
       Route::get('/create', 'PostController@create');
       Route::post('/create', 'PostController@store');
       Route::get('/update/{post}', 'PostController@edit');
       Route::post('/update/{post}', 'PostController@update');
   });

});

Route::group(['prefix' => 'jobs'], function() {
   Route::get('/', 'JobController@index');

   Route::get('/{job}', 'JobController@show');
});

