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
 | BUSCADOR
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Realizar búsqueda

Route::post('/search', 'SearchController@do')->name('search');


// Resultados de la búsqueda

Route::get('/search/{keyword}/{page?}', 'SearchController@results')->name('search.results');


/*
 |
 | PÁGINAS ESTÁTICAS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Políticas de privacidad
Route::get('/policy', 'PageController@policy')->name('page.policy');

// Términos y condiciones
Route::get('/terms', 'PageController@terms')->name('page.terms');


/*
 |
 | FORMULARIOS DE FEEDBACK
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Reportar errores
Route::post('/feedback/bugs', 'FeedbackController@bugs')->name('feedback.bugs');

// Enviar consultas
Route::post('/feedback/question', 'FeedbackController@question')->name('feedback.question');

// Reportar problemas en un item
Route::post('/feedback/problem', 'FeedbackController@problem')->name('feedback.problem');


/*
 |
 | RUTAS PARA USERS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Recuperar contraseña

Route::post('/user/pass/recover', 'UserController@passRecover')
->name('user.pass.recover');


// Recuperar contraseña (cargar código)

Route::get('/user/pass/code/{user_token}', 'UserController@passRecoverCode')
->name('user.pass.code')
->where('user_token', '[a-zA-Z0-9]{60}');


// Recuperar contraseña (validar código)

Route::post('/user/pass/validate', 'UserController@passValidateCode')
->name('user.pass.validate');


// Recuperar contraseña (ingresar una nueva)

Route::get('/user/pass/changepass/{user_token}', 'UserController@passChangePass')
->name('user.pass.changepass')
->where('user_token', '[a-zA-Z0-9]{60}');


// Recuperar contraseña (validar nueva contraseña)

Route::post('/user/pass/new', 'UserController@passValidateNew')
->name('user.pass.new');


// Información de usuario

Route::get('/user/home', 'UserController@home')
->name('user.home');


// Edición de datos de usuario

Route::get('/user/account', 'UserController@account')
->name('user.account');


// Edición de datos de usuario

Route::post('/user/account/update', 'UserController@accountUpdate')
->name('user.account.update');


// Validación AJAX de campo email

Route::get('/user/validate/email/{email}', 'UserController@validateEmail')
->name('user.validate.email');


// Validación AJAX de nickname

Route::get('/user/validate/nickname/{nickname}', 'UserController@validateNick')
->name('user.validate.nickname');


// Upload de foto de perfil

Route::post('/user/photo/upload', 'UserController@photoUpload')
->name('user.photo.upload');


// Optimización de foto de perfil

Route::get('/user/photo/resize', 'UserController@photoResize')
->name('user.photo.resize');


// Recorte de foto de perfil (seleccionar área)

Route::get('/user/photo/crop', 'UserController@photoCrop')
->name('user.photo.crop');


// Recorte de foto de perfil (procesar recorte)

Route::post('/user/photo/cropper', 'UserController@photoCropper')
->name('user.photo.cropper');


// Edición de datos de usuario

Route::get('/user/account/update', 'UserController@accountUpdate')
->name('user.account.update');


// Edición de datos de usuario

Route::get('/user/edit', 'UserController@edit')
->name('user.edit');


// Edición de datos de usuario

Route::post('/user/update', 'UserController@update')
->name('user.update');


// Edición de datos de contacto

Route::get('/user/contact', 'UserController@contact')
->name('user.contact');


// Edición de datos de contacto

Route::post('/user/contact/update', 'UserController@contactUpdate')
->name('user.contact.update');


// Favoritos del usuario

Route::get('/user/likes', 'UserController@likes')
->name('user.likes');


// Eliminar item de favoritos

Route::get('/user/like/delete/{item_id}', 'UserController@likeDelete')
->name('user.like.delete');


// Edición de datos de usuario

Route::get('/user/preferences', 'UserController@preferences')
->name('user.preferences');


/*
 |
 | RUTAS PARA ITEMS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Detalle del item

Route::get('/item/{name}_{id}', 'ItemController@detail')
->name('item.detail')
->where('name', '[a-z0-9-]+')
->where('id', '[0-9]+');


// Like / Unlike

Route::get('/item/like/{item_id}', 'ItemController@like')
->name('item.like');


// Detalle del item

Route::get('/purchase/{item_id}', 'ItemController@purchase')
->name('item.purchase');


/*
 |
 | RUTAS DEL CARRITO
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Carrito de compras (vista general)

Route::get('/cart', 'CartController@items')
->name('cart.items');


// Carrito de compras (Agregar / quitar)

Route::get('/cart/add/{item_id}', 'CartController@add')
->name('cart.add');


// Aumentar cantidad de unidades

Route::get('/cart/increase/{item_id}', 'CartController@increase')
->name('cart.increase');


// Disminuir cantidad de unidades

Route::get('/cart/decrease/{item_id}', 'CartController@decrease')
->name('cart.decrease');


// Vaciar carrito de compras

Route::get('/cart/clean', 'CartController@clean')
->name('cart.clean');


/*
 |
 | RUTAS DEL VENTAS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Seleccionar forma de envío

Route::get('/sale/shipping', 'SaleController@shipping')
->name('sale.shipping');


// Guardar medio de envío

Route::post('/sale/shipping/save', 'SaleController@shippingSave')
->name('sale.shipping.save');


// Seleccionar método de pago

Route::get('/sale/payment', 'SaleController@payment')
->name('sale.payment');


/*
 |
 | RUTAS PARA STORES
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/


// Lista de stores de un usuario

Route::get('/stores', 'StoreController@list')
->name('store.list');


// Formulario nuevo store

Route::get('/store/new', 'StoreController@new')
->name('store.new');


// Guardado del nuevo store

Route::post('/store/save', 'StoreController@save')
->name('store.save');


// Validación del alias de un store

Route::get('/store/alias/validate/{alias}/{store_id?}', 'StoreController@aliasValidate')
->name('store.alias.validate');


// Portada de administración de un store

Route::get('/store/{alias}', 'StoreController@home')
->name('store.home')
->where('alias', '[a-z0-9._]+');


// Formulario de edición de datos del store

Route::get('/store/edit/{alias}', 'StoreController@edit')
->name('store.edit')
->where('alias', '[a-z0-9._]+');


// Guardado de modificaciones en el store

Route::post('/store/update', 'StoreController@update')
->name('store.update');


// Formulario de edición de datos de contacto

Route::get('/store/data/{alias}', 'StoreController@data')
->name('store.data')
->where('alias', '[a-z0-9._]+');


// Guardado de modificaciones en los datos de contacto

Route::post('/store/data/update', 'StoreController@updateData')
->name('store.update.data');


// Configuración del shop (tienda)

Route::get('/store/eshop/{alias}', 'StoreController@shopConfig')
->name('store.shop.config')
->where('alias', '[a-z0-9._]+');


// Guardado de las configuraciones del shop

Route::post('/store/eshop/save', 'StoreController@shopConfigSave')
->name('store.shopConfigSave');


// Guardado de cambios en la opacidad de la cabecera

Route::get('/store/eshop/opacity/{store_id}/{opacity}', 'StoreController@setHeaderOpacity')
->name('store.header.opacity')
->where('store_id', '[0-9]+')
->where('opacity', '[0-9]+');


// Upload de foto de portada (cabecera)

Route::post('/store/eshop/header/upload', 'StoreController@headerUpload')
->name('store.header.upload');


// Optimización (peso/tamaño) de foto de portada (cabecera)

Route::get('/store/eshop/header/resize/{alias}', 'StoreController@headerResize')
->name('store.header.resize')
->where('alias', '[a-z0-9._]+');


// Recorte de foto de portada (seleccionar área de recorte)

Route::get('/store/eshop/header/crop/{alias}', 'StoreController@headerCrop')
->name('store.header.crop')
->where('alias', '[a-z0-9._]+');

	
// Recorte de foto de portada (procesar recorte)

Route::post('/store/eshop/header/cropper', 'StoreController@headerCropper')
->name('store.header.cropper');


// Upload de foto de perfil (logo o marca)

Route::post('/store/eshop/profile/upload', 'StoreController@profileUpload')
->name('store.profile.upload');


// Optimización (peso/tamaño) de foto de perfil (cabecera)

Route::get('/store/eshop/profile/resize/{alias}', 'StoreController@profileResize')
->name('store.profile.resize')
->where('alias', '[a-z0-9._]+');


// Recorte de foto de perfil (seleccionar área de recorte)

Route::get('/store/eshop/profile/crop/{alias}', 'StoreController@profileCrop')
->name('store.profile.crop')
->where('alias', '[a-z0-9._]+');

	
// Recorte de foto de perfil (procesar recorte)

Route::post('/store/eshop/profile/cropper', 'StoreController@profileCropper')
->name('store.profile.cropper');


// Activar tienda

Route::get('/store/eshop/status/{alias}', 'StoreController@shopStatus')
->name('store.shop.status')
->where('alias', '[a-z0-9._]+');


// Administradores del store

Route::get('/store/admins/{alias}', 'StoreController@admins')
->name('store.admins')
->where('alias', '[a-z0-9._]+');


// Nuevo administrador para el store

Route::get('/store/admins/new/{alias}', 'StoreController@newAdmin')
->name('store.newAdmin');


// Guardar el nuevo administrador para el store

Route::post('/store/admins/save', 'StoreController@saveAdmin')
->name('store.saveAdmin');


// Editar administrador para el store

Route::get('/store/admins/edit/{alias}', 'StoreController@editAdmin')
->name('store.editAdmin')
->where('alias', '[a-z0-9._]+');


// Guardar cambios en un administrador del store

Route::post('/store/admins/update', 'StoreController@updateAdmin')
->name('store.saveAdmin');


// Habilitar / Deshabilitar el store (advertencia)

Route::get('/store/status/{alias}', 'StoreController@status')
->name('store.status')
->where('alias', '[a-z0-9._]+');


// Habilitar / Deshabilitar el store (confirmar)

Route::get('/store/status/change/{alias}', 'StoreController@changeStatus')
->name('store.status.change')
->where('alias', '[a-z0-9._]+');


// Dar de baja el store

Route::get('/store/delete/{alias}', 'StoreController@delete')
->name('store.delete')
->where('alias', '[a-z0-9._]+');


// Dar de baja el store

Route::get('/store/delete/confirm/{alias}', 'StoreController@deleteConfirm')
->name('store.delete.confirm')
->where('alias', '[a-z0-9._]+');



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


// Crear oferta

Route::post('/store/item/offer', 'ItemController@offer')
->name('item.offer');


// Eliminar oferta

Route::get('/item/offer/delete/{item_id}', 'ItemController@offerDelete')
->name('item.offer.delete');


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


/*
 |
 | MENSAJES
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Consulta sobre el item

Route::post('/message/send', 'MessageController@send')
->name('item.message');


// Listado de mensajes (Store)

Route::get('/store/{alias}/messages', 'MessageController@store')
->name('store.messages')
->where('alias', '[a-z0-9._]+');


// Leer un hilo de mensajes (Store)

Route::get('/store/{alias}/message/read/{message_id}', 'MessageController@readStore')
->name('store.message.read')
->where('message_id', '[0-9]+')
->where('alias', '[a-z0-9._]+');


// Lista de mensajes (Usuario)

Route::get('/user/messages', 'MessageController@user')
->name('user.messages');


// Leer hilo de mensajes (Usuario)

Route::get('/user/message/read/{message_id}', 'MessageController@readUser')
->name('user.message.read');


// Enviar respuesta

Route::post('/message/answer', 'MessageController@answer')
->name('message.answer');


// Eliminar mensaje (Usuario)

Route::get('/user/message/delete/{message_id}', 'MessageController@delete')
->name('user.message.delete');


/*
 |
 | MAILS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Bienvenida de usuario

Route::get('/mail/user/welcome/{user_id}/{debug?}', 'MailController@userWelcome')
->name('mail.user.welcome')
->where('user_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Recuperación de contraseña

Route::get('/mail/user/recoverpass/{user_id}/{debug?}', 'MailController@userRecoverPass')
->name('mail.user.recoverpass')
->where('user_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Confirmación de contraseña

Route::get('/mail/user/changepass/{user_id}/{debug?}', 'MailController@userChangePass')
->name('mail.user.changepass')
->where('user_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Nuevo mensaje

Route::get('/mail/user/newmessage/{user_id}/{debug?}', 'MailController@userNewMessage')
->name('mail.user.newmessage')
->where('user_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

// Nuevo negocio creado (Bienvenida)

Route::get('/mail/store/new/{store_id}/{debug?}', 'MailController@storeNew')
->name('mail.store.new')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Habilitación / Deshabilitación de negocio

Route::get('/mail/store/statuschange/{store_id}/{debug?}', 'MailController@storeStatusChange')
->name('mail.store.statuschange')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Eliminación de negocio

Route::get('/mail/store/delete/{store_id}/{debug?}', 'MailController@storeDelete')
->name('mail.store.delete')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Nuevo mensaje

Route::get('/mail/store/newmessage/{store_id}/{debug?}', 'MailController@storeNewMessage')
->name('mail.store.newmessage')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Denuncia de un artículo

Route::get('/mail/store/claim/{item_id}/{debug?}', 'MailController@storeClaim')
->name('mail.store.claim')
->where('item_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

// Nuevo usuario

Route::get('/mail/root/newuser/{user_id}/{debug?}', 'MailController@rootNewUser')
->name('mail.root.newuser')
->where('user_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Nuevo negocio

Route::get('/mail/root/newstore/{store_id}/{debug?}', 'MailController@rootStoreNew')
->name('mail.root.newstore')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Negocio eliminado

Route::get('/mail/root/storedeleted/{store_id}/{debug?}', 'MailController@rootStoreDeleted')
->name('mail.root.storedeleted')
->where('store_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Denuncia a un artículo

Route::get('/mail/root/claim/{report_id}/{debug?}', 'MailController@rootClaim')
->name('mail.root.claim')
->where('report_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Reporte de un error en la página

Route::get('/mail/root/reporting/{reporting_id}/{debug?}', 'MailController@rootReporting')
->name('mail.root.reporting')
->where('reporting_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


// Consulta desde la página

Route::get('/mail/root/question/{question_id}/{debug?}', 'MailController@rootQuestion')
->name('mail.root.question')
->where('question_id', '[0-9]{1,11}')
->where('debug', '[a-z]{4,5}');


/*
 |
 | TIENDAS
 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

// Portada del store

Route::get('/{alias}', 'ShopController@home')
->name('store.index')
->where('alias', '[a-z0-9._]+');