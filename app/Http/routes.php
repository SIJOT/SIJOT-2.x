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
 * Rental routes.
 */
Route::get('/backend/rental', 'VerhuurBackendController@index');
Route::get('/backend/rentald', 'VerhuurBackendController@');
Route::get('/backend/rentalz', 'VerhuurBackendController@');
Route::get('/backend/rentalr', 'VerhuurBackendController@');
Route::get('/backend/rentale', 'VerhuurBackendController@');

/**
 * Backend: User management.
 */
Route::get('/backend/acl/profile/{id}', 'UserManagement@UserProfile');
Route::get('/backend/acl', 'UserManagement@getIndex');
Route::get('/backend/acl/block/{id}', 'AuthorizationController@blockUser');
Route::get('/backend/acl/unblock/{id}', 'AuthorizationController@unBlockUser');
Route::get('/backend/acl/delete/{id}', 'AuthorizationController@deleteUser');

/**
 * Log API.
 */

/**
 * Cloud routes.
 */
Route::get('/cloud/index', 'CloudController@index');
Route::post('/cloud/upload', 'CloudController@uploadFile');
Route::get('/cloud/delete/{id}', 'CloudController@deleteFile');
Route::get('/cloud/download/{id}', 'CloudController@downloadFile');