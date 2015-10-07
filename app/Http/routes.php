<?php

/**
 |--------------------------------------------------------------------------
 | Application Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register all of the routes for an application.
 | It's a breeze. Simply tell Laravel the URIs it should respond to
 | and give it the controller to call when that URI is requested.
 |
 */
Route::get('/', 'HomeController@index');

// Group routes.
Route::get('/takken', 'TakkenViewController@TakAll');
Route::get('/takken/{fragment}', 'TakkenViewController@Tak');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Logout routes..
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/**
 * Back-end routes.
 */
Route::get('/backend/takken/update/{fragment}', 'TakkenViewController@getUpdate');
Route::post('/backend/takken/update', 'TakkenViewController@postUpdate');