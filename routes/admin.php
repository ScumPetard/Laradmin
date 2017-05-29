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
Route::any('/','SignController@sign')->name('admin.sign');

Route::group(['middleware' => 'permission'], function () {
    Route::any('/signout','SignController@signOut')->name('admin.signout');

    Route::get('/index', 'IndexController@index')->name('admin.index');


    /**
     * User
     */
    Route::get('/user','UserController@index')->name('admin.user.index');
    Route::any('/user/create','UserController@create')->name('admin.user.create');
    Route::any('/user/edit/{id}','UserController@edit')->name('admin.user.edit');
    Route::get('/user/destroy/{id}','UserController@destroy')->name('admin.user.destroy');

    /**
     * Role
     */
    Route::get('/role','RoleController@index')->name('admin.role.index');
    Route::any('/role/create','RoleController@create')->name('admin.role.create');
    Route::any('/role/edit/{id}','RoleController@edit')->name('admin.role.edit');
    Route::get('/role/destroy/{id}','RoleController@destroy')->name('admin.role.destroy');

    /**
     * Permission
     */
    Route::get('/permission','PermissionController@index')->name('admin.permission.index');
    Route::any('/permission/create','PermissionController@create')->name('admin.permission.create');
    Route::any('/permission/edit/{id}','PermissionController@edit')->name('admin.permission.edit');
    Route::get('/permission/destroy/{id}','PermissionController@destroy')->name('admin.permission.destroy');
});
