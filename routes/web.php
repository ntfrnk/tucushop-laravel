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
Route::get('/', 'HomeController@index')->name('home');


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


// Lista de stores de un usuario

Route::get('/stores', 'StoreController@list')
		->name('store.list');


// Portada del store

Route::get('/{alias}', 'StoreController@index')
		->name('store.index')
		->where('alias', '[a-z._]+');


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

Route::post('/store/data/update', 'StoreController@updateData')
		->name('store.update.data');


// Configuración del shop (tienda)

Route::get('/store/eshop/{alias}', 'StoreController@shopConfig')
		->name('store.shopConfig')
		->where('alias', '[a-z._]+');


// Guardado de las configuraciones del shop

Route::post('/store/eshop/save', 'StoreController@shopConfigSave')
		->name('store.shopConfigSave');


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


// Habilitar / Deshabilitar el store (advertencia)

Route::get('/store/status/{alias}', 'StoreController@status')
		->name('store.status')
		->where('alias', '[a-z._]+');


// Habilitar / Deshabilitar el store (confirmar)

Route::get('/store/status/change/{alias}', 'StoreController@changeStatus')
		->name('store.status.change')
		->where('alias', '[a-z._]+');


// Dar de baja el store

Route::get('/store/delete/{alias}', 'StoreController@delete')
		->name('store.delete')
		->where('alias', '[a-z._]+');


// Dar de baja el store

Route::get('/store/delete/confirm/{alias}', 'StoreController@deleteConfirm')
		->name('store.delete.confirm')
		->where('alias', '[a-z._]+');



/*
 |
 | RUTAS PARA ITEMS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Listado de items

Route::get('/store/items/{alias}/{page?}', 'ItemController@items')
		->name('items')
		->where('alias', '[a-z._]+');


// Tipo de vista en listados

Route::get('/items/{alias}/{style}', 'ItemController@itemListType')
		->name('item.list.type')
		->where('alias', '[a-z._]+')
		->where('style', '[a-z]{4}');


// Formulario de nuevo item

Route::get('/store/item/new/{alias}', 'ItemController@new')
		->name('item.new')
		->where('alias', '[a-z._]+');


// Guardado del nuevo item

Route::post('/store/item/save', 'ItemController@save')
		->name('item.save');


// Formulario para editar un item

Route::get('/store/item/edit/{alias}/{item_id}', 'ItemController@edit')
		->name('item.edit')
		->where('alias', '[a-z._]+')
		->where('item_id', '[0-9]+');


// Guardado de cambios en el item

Route::post('/store/item/update', 'ItemController@update')
		->name('item.update');


// Gestión de fotos de un item

Route::get('/store/item/photos/{alias}/{item_id}', 'ItemController@photos')
		->name('item.photos')
		->where('alias', '[a-z._]+')
		->where('item_id', '[0-9]+');


// Guardado de la foto cargada

Route::post('/store/item/photo/upload', 'ItemController@upload')
		->name('item.photo.upload');


// Redimensionar foto (optimizar tamaño / calidad)

Route::get('/store/item/resize/{photo_id}', 'ItemController@resizePhoto')
		->name('item.photo.resize')
		->where('photo_id', '[0-9]+');


// Recortar foto (seleccionar área de recorte)

Route::get('/store/item/crop/{alias}/{item_id}/{photo_id}', 'ItemController@cropPhoto')
		->name('item.photo.crop')
		->where('alias', '[a-z._]+')
		->where('item_id', '[0-9]+')
		->where('photo_id', '[0-9]+');


// Recortar foto 

Route::post('/store/item/crop/', 'ItemController@cropper')
		->name('item.photo.cropper');


// Ordenar las fotos

Route::get('/store/item/photo/order/{neworder}', 'ItemController@orderPhoto')
		->name('item.photo.order')
		->where('neworder', '[a-z0-9,_]+');


// Eliminar una foto

Route::get('/store/item/photo/delete/{photo_id}', 'ItemController@deletePhoto')
		->name('item.photo.delete')
		->where('photo_id', '[0-9]+');


// Agregar característica al item
Route::post('/item/feature/add', 'ItemController@addFeature')
		->name('item.feature.add');


// Eliminar característica del item
Route::get('/item/feature/delete/{item_id}/{feature_id}', 'ItemController@deleteFeature')
		->name('item.feature.delete')
		->where('item_id', '[0-9]+')
		->where('feature_id', '[0-9]+');


// Agregar una tag al item
Route::post('/item/tag/add', 'ItemController@addTag')
		->name('item.tag.add');


// Eliminar tag del item
Route::get('/item/tag/delete/{item_id}/{keyword_id}', 'ItemController@deleteTag')
		->name('item.tag.delete')
		->where('item_id', '[0-9]+')
		->where('keyword_id', '[0-9]+');


// Cambio de estado en el item (activado / desactivado)

Route::get('/store/item/status/{item_id}/{editing?}', 'ItemController@status')
		->name('item.status');


// Eliminación de un item

Route::get('/store/item/delete/{item_id}', 'ItemController@delete')
		->name('item.delete');