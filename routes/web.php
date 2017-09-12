<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('/overview', 'PagesController@overview')->name('overview');

Route::prefix('manage')->group(function(){
    Route::resource('users', 'UserController');
    Route::resource('groups', 'GroupController');
    Route::resource('roles', 'RoleController'); 
    Route::resource('permissions', 'PermissionController');
    Route::resource('clients', 'ClientController');
    //Route::get('/', 'PagesController@getLojista')->name('lojista.index');
});
