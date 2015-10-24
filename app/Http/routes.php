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

/**
 * Authorization routes.
 */
Route::get('/login', 'AuthorizationController@viewLogin');
Route::post('/login', 'AuthorizationController@verifyLogin');

Route::get('/logout', 'AuthorizationController@getLogout');

/**
 * Back-end routes.
 */
Route::get('/backend/takken/update', 'TakkenViewController@getUpdate');
Route::post('/backend/takken/update', 'TakkenViewController@postUpdate');

/**
 * Backend: User management.
 */
Route::get('/backend/acl', 'UserManagement@getIndex');