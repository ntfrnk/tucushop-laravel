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

Route::get('/', 'HomeController@index')->name('home');

/*
** RUTAS PARA USERS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

Route::get('/user/home', 'UserController@home')->name('user.home');
Route::get('/user/edit', 'UserController@edit')->name('user.edit');

/*
** RUTAS PARA ITEMS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Detalle del item
Route::get('/item/{name}_{id}.tshop', 'ItemController@detail')
		->name('item.detail')
		->where('name', '[a-z0-9-]+')
		->where('id', '[0-9]+');

// Detalle del item
Route::get('/purchase/{item_id}', 'ItemController@purchase')->name('item.purchase');


/*
** RUTAS PARA STORES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Portada del store
Route::get('/{alias}', 'StoreController@index')->name('store.index')->where('alias', '[a-z._]+');

// Lista de stores de un usuario
Route::get('/stores', 'StoreController@list')->name('store.list')->where('alias', '[a-z._]+');