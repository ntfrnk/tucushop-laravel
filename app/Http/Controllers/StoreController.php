<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Type;
use App\Item;
use App\StoreAdmin;
use App\Message;
use App\Feature;

class StoreController extends Controller {

	public function __construct(){
		$this->middleware("auth");
	}
    
	/* Portada del e-shop o tienda
	---------------------------------------------------- */
	public function index(){
		echo "Portada del shop";
	}


	/* Listado de stores propios
	---------------------------------------------------- */
	public function list(){
		echo "Listado de stores propios";
	}


	/* Portada de administración del store
	---------------------------------------------------- */
	public function home($alias){

		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.home', [
				'store' => $store
				]);

		} else {

			return redirect()->route('store.list');

		}

		
	}


	/* Formulario para agregar un store
	---------------------------------------------------- */
	public function new(){
		echo "Agregar un store";
	}


	/* Guardado de un nuevo store
	---------------------------------------------------- */
	public function save(){
		// Guardado de nuevo store
	}


	/* Formulario de edición de datos del store
	---------------------------------------------------- */
	public function edit($alias){

		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$types = Type::orderBy('id','asc')->get();

			return view('store.modules.edit', [
				'store' => $store,
				'types' => $types
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Guardado de datos editados en un store
	---------------------------------------------------- */
	public function update(){
		// Guardado de datos editados
	}


	/* Formulario de edición de datos de contacto
	---------------------------------------------------- */
	public function data($alias){

		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.data', [
				'store' => $store
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Guardado de datos de contacto editados
	---------------------------------------------------- */
	public function updateData(){
		// Guardado de datos editados
	}


	/* Formulario de configuración del eshop
	---------------------------------------------------- */
	public function shopConfig(){
		echo "Configuración del eshop";
	}


	/* Guardado de configuraciones del shop
	---------------------------------------------------- */
	public function shopConfigSave(){
		// Guardado de configuraciones del shop
	}


	/* Gestión de administradores (listado)
	---------------------------------------------------- */
	public function admins($alias){

		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$admins = StoreAdmin::where('store_id', $store->id)
						->orderBy('role_id', 'asc')
						->paginate(5);

			return view('store.modules.admins', [
				'store' => $store,
				'admins' => $admins
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Formulario de nuevo administrador
	---------------------------------------------------- */
	public function newAdmin(){
		echo "Formulario de nuevo administrador";
	}


	/* Guardado de un nuevo administrador
	---------------------------------------------------- */
	public function saveAdmin(){
		// Guardado de nuevo administrador
	}


	/* Formulario de edición de un administrador
	---------------------------------------------------- */
	public function editAdmin(){
		echo "Edición de administrador";
	}


	/* Guardado de cambios de un administrador
	---------------------------------------------------- */
	public function updateAdmin(){
		// Guardado de cambios del administrador
	}


	/* Gestión de mensajes (Bandeja de entrada)
	---------------------------------------------------- */
	public function messages($alias){
		
		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$messages = Message::where('store_id', $store->id)
						->orderBy('Id', 'desc')
						->paginate(5);

			return view('store.modules.messages', [
				'store' => $store,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Cambio de estado del store (Activo / inactivo)
	---------------------------------------------------- */
	public function status($alias){
		
		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.status_change', [
				'store' => $store
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Cambio de estado del store (Activo / inactivo)
	---------------------------------------------------- */
	public function changeStatus($alias){
		
		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			$store->status = $store->status == 1 ? 0 : 1;
			$store->save();

			return redirect()->route('store.home', ['alias' => $store->alias]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Eliminación de un store (Advertencia)
	---------------------------------------------------- */
	public function delete($alias){
		
		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.delete', [
				'store' => $store
			]);

		} else {

			return redirect()->route('store.list');

		}

	}


	/* Eliminación lógica de un store
	** (sólo se marca la casilla "deleted")
	---------------------------------------------------- */
	public function deleteConfirm($alias){
		
		if(\Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			$store->deleted = 1;
			$store->save();

			return redirect()->route('store.list');

		} else {

			return redirect()->route('store.list');

		}

	}

}
