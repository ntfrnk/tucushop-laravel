<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Type;
use App\Item;
use App\StoreAdmin;
use App\Message;

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

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.home', [
				'store' => $store
			]);

		} else {

			return redirect()->route('home');

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

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();
			$types = Type::orderBy('id','asc')->get();

			return view('store.modules.edit', [
				'store' => $store,
				'types' => $types
			]);

		} else {

			return redirect()->route('home');

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

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.data', [
				'store' => $store
			]);

		} else {

			return redirect()->route('home');

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


	/* Listado de items
	---------------------------------------------------- */
	public function items($alias){

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();
			$items = Item::where('store_id', $store->id)
						->orderBy('name', 'asc')
						->paginate(5);

			return view('store.modules.items', [
				'store' => $store,
				'items' => $items
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Formulario de nuevo item
	---------------------------------------------------- */
	public function newItem($alias){
		
		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();

			return view('store.modules.item_form', [
				'store' => $store
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Guardado del nuevo item
	---------------------------------------------------- */
	public function saveItem(){
		// Guardado de nuevo administrador
	}


	/* Formulario de edición de un item
	---------------------------------------------------- */
	public function editItem($alias, $item_id){

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();
			$item = Item::find($item_id);

			return view('store.modules.item_form', [
				'store' => $store,
				'item' => $item
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Guardado de cambios en el item
	---------------------------------------------------- */
	public function updateItem(){
		// Guardado de nuevo administrador
	}


	/* Gestión de administradores (listado)
	---------------------------------------------------- */
	public function admins($alias){

		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();
			$admins = StoreAdmin::where('store_id', $store->id)
						->orderBy('role_id', 'asc')
						->paginate(5);

			return view('store.modules.admins', [
				'store' => $store,
				'admins' => $admins
			]);

		} else {

			return redirect()->route('home');

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
		
		if(\Help::isAdmin($alias)){

			$store = Store::where('alias', $alias)->first();
			$messages = Message::where('store_id', $store->id)
						->orderBy('Id', 'desc')
						->paginate(5);

			return view('store.modules.messages', [
				'store' => $store,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Cambio de estado del store (Activo / inactivo)
	---------------------------------------------------- */
	public function changeStatus(){
		// Cambio de estado (Activo / inactivo)
	}


	/* Eliminación lógica de un store
	** (sólo se marca la casilla "deleted")
	---------------------------------------------------- */
	public function delete(){
		// No se elimina, sólo se marca la casilla "deleted"
	}

}
