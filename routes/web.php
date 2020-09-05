<?php

use Illuminate\Support\Facades\Route;


Route::post('/posts','PostController@store');
Route::get('/posts','PostController@index');
Route::get('/posts/{post}','PostController@show');   
Route::put('/posts/{post}','PostController@update');
Route::delete('/posts/{post}','PostController@destroy');