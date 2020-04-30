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


/*
 |
 | RUTAS GENERALES
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Home del sitio

Route::get('/', 'HomeController@index')
		->name('home');


/*
 |
 | RUTAS PARA USERS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Información de usuario

Route::get('/user/home', 'UserController@home')
		->name('user.home');


// Edición de datos de usuario

Route::get('/user/edit', 'UserController@edit')
		->name('user.edit');

/*
 |
 | RUTAS PARA ITEMS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Detalle del item

Route::get('/item/{name}_{id}.tshop', 'ItemController@detail')
		->name('item.detail')
		->where('name', '[a-z0-9-]+')
		->where('id', '[0-9]+');


// Detalle del item

Route::get('/purchase/{item_id}', 'ItemController@purchase')
		->name('item.purchase');


/*
 |
 | RUTAS PARA STORES
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Portada del store

Route::get('/{alias}', 'StoreController@index')
		->name('store.index')
		->where('alias', '[a-z._]+');


// Lista de stores de un usuario

Route::get('/stores', 'StoreController@list')
		->name('store.list');


// Formulario nuevo store

Route::get('/store/new', 'StoreController@new')
		->name('store.new');


// Guardado del nuevo store

Route::post('/store/save', 'StoreController@save')
		->name('store.save');


// Portada de administración de un store

Route::get('/store/{alias}', 'StoreController@home')
		->name('store.home')
		->where('alias', '[a-z._]+');


// Formulario de edición de datos del store

Route::get('/store/edit/{alias}', 'StoreController@edit')
		->name('store.edit')
		->where('alias', '[a-z._]+');


// Guardado de modificaciones en el store

Route::post('/store/update', 'StoreController@update')
		->name('store.update');


// Formulario de edición de datos de contacto

Route::get('/store/data/{alias}', 'StoreController@data')
		->name('store.data')
		->where('alias', '[a-z._]+');


// Guardado de modificaciones en los datos de contacto

Route::post('/store/updateData', 'StoreController@updateData')
		->name('store.updateData');


// Configuración del shop (tienda)

Route::get('/store/eshop/{alias}', 'StoreController@shopConfig')
		->name('store.shopConfig')
		->where('alias', '[a-z._]+');


// Guardado de las configuraciones del shop

Route::post('/store/eshop/save', 'StoreController@shopConfigSave')
		->name('store.shopConfigSave');


// Listado de items

Route::get('/store/items/{alias}/{page?}', 'StoreController@items')
		->name('store.items')
		->where('alias', '[a-z._]+');


// Formulario de nuevo item

Route::get('/store/item/new/{alias}', 'StoreController@newItem')
		->name('store.item.new')
		->where('alias', '[a-z._]+');


// Guardado del nuevo item

Route::post('/store/item/save', 'StoreController@saveItem')
		->name('store.item.save');


// Formulario para editar un item

Route::get('/store/item/edit/{alias}/{item_id}', 'StoreController@editItem')
		->name('store.item.edit')
		->where('alias', '[a-z._]+')
		->where('item_id', '[0-9]+');


// Guardado de cambios en el item

Route::post('/store/item/update', 'StoreController@updateItem')
		->name('store.item.update');


// Administradores del store

Route::get('/store/admins/{alias}', 'StoreController@admins')
		->name('store.admins')
		->where('alias', '[a-z._]+');


// Nuevo administrador para el store

Route::get('/store/admins/new/{alias}', 'StoreController@newAdmin')
		->name('store.newAdmin');


// Guardar el nuevo administrador para el store

Route::post('/store/admins/save', 'StoreController@saveAdmin')
		->name('store.saveAdmin');


// Editar administrador para el store

Route::get('/store/admins/edit/{alias}', 'StoreController@editAdmin')
		->name('store.editAdmin')
		->where('alias', '[a-z._]+');


// Guardar cambios en un administrador del store

Route::post('/store/admins/update', 'StoreController@updateAdmin')
		->name('store.saveAdmin');


// Listado de mensajes

Route::get('/store/messages/{alias}', 'StoreController@messages')
		->name('store.messages')
		->where('alias', '[a-z._]+');


// Habilitar / Deshabilitar el store

Route::get('/store/status/{alias}', 'StoreController@changeStatus')
		->name('store.status')
		->where('alias', '[a-z._]+');


// Dar de baja el store

Route::get('/store/delete/{alias}', 'StoreController@delete')
		->name('store.delete')
		->where('alias', '[a-z._]+');