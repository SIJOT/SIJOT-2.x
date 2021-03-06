<?php

/**
 * This file is necessary in a basic laravel platform. but we use annotations
 * So this file is pretty useless. You can find more info in the routing
 * documentation of this project.
 */

// Route::get('/', 'HomeController@index');

// Group routes.
// Route::get('/takken', 'TakkenViewController@TakAll');
// Route::get('/takken/{fragment}', 'TakkenViewController@Tak');

/*
 * Authorization routes.
 */
// Route::get('/login', 'AuthorizationController@viewLogin');
// Route::post('/login', 'AuthorizationController@verifyLogin');

// Route::get('/logout', 'AuthorizationController@getLogout');

/*
 * Back-end routes.
 */
// Route::get('/backend/takken/update', 'TakkenViewController@getUpdate');
// Route::post('/backend/takken/update', 'TakkenViewController@postUpdate');

/*
 * Ontbijt routes.
 */

/*
 * Notification routes.
 */
// Route::get('/notification/uit/{id}', 'notificationsController@VerhuurUit');
// Route::get('/notification/aan/{id}', 'notificationsController@VerhuurAan');

/*
 * Rental routes.
 */
// Front-end
// Route::get('/verhuur', 'VerhuurController@index');
// Route::post('/rental/insert', 'VerhuurBackendController@store');
// Route::get('/verhuur/aanvragen', 'VerhuurController@aanvragen');
// Route::get('/verhuur/bereikbaarheid', 'VerhuurController@bereikbaarheid');
// Route::get('/verhuur/kalender', 'VerhuurBackendController@getCalendar');

// Backend
// Route::get('/backend/rental', 'VerhuurBackendController@index');
// Route::get('/backend/rental/contract', 'VerhuurBackendController@downloadContract');
// Route::get('/backend/rental/option/{id}', 'VerhuurBackendController@option');
// Route::get('/backend/rental/confirm/{id}', 'VerhuurBackendController@confirmed');
// Route::get('/backend/rental/delete/{id}', 'VerhuurBackendController@destroy');

/*
 * Backend: User management.
 */
// Route::get('/backend/acl/profile/{id}', 'UserManagement@UserProfile');
// Route::get('/backend/acl', 'UserManagement@getIndex');
// Route::post('/backend/acl/register', 'AuthorizationController@Register');
// Route::get('/backend/acl/block/{id}', 'AuthorizationController@blockUser');
// Route::get('/backend/acl/unblock/{id}', 'AuthorizationController@unBlockUser');
// Route::get('/backend/acl/delete/{id}', 'AuthorizationController@deleteUser');
// Route::post('/backend/acl/changeCredentials/{id}', 'UserManagement@changeCredentials');

// Password reset routes...

/*
 * Cloud routes.
 */
// Route::get('/cloud/index', 'CloudController@index');
// Route::post('/cloud/upload', 'CloudController@uploadFile');
// Route::get('/cloud/delete/{id}', 'CloudController@deleteFile');
// Route::get('/cloud/download/{id}', 'CloudController@downloadFile');
