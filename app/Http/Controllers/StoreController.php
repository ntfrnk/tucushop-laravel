<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use App\Store;
use App\Type;
use App\Item;
use App\StoreAdmin;
use App\StoreShop;
use App\StoreProfile;
use App\Message;
use App\Feature;

class StoreController extends Controller {
    
	/* Portada del e-shop o tienda
	---------------------------------------------------- */
	public function index(){
		echo "Portada del shop";
	}


	/* Listado de stores propios
	---------------------------------------------------- */
	public function list(){

		if(\Auth::user()) {

			$stores = Store::whereHas('admins', function(Builder $query){
								$user = \Auth::user();
								$query->where('user_id', $user->id);
							})
							->orderby('id','asc')
							->get();

			return view('store.modules.stores', [
				'stores' => $stores
				]);

		} else {

			return redirect()->route('login');

		}

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

		if(\Auth::user()) {

			$types = Type::orderBy('id','asc')->get();

			return view('store.modules.new', [
				'types' => $types
			]);

		} else {

			return redirect()->route('login');

		}
	}


	/* Guardado de un nuevo store
	---------------------------------------------------- */
	public function save(Request $request){

		if(\Auth::user()) {
		
			$validate = $this->validate($request, [
				'name' => 'required|string|min:5|max:50|unique:stores',
				'type_id' => 'required|integer',
				'description' => 'required|string',
				'alias' => 'required|string|min:5|max:30|unique:stores'
			]);

			/** Agrego el nuevo store */
			
			$store = new Store();
			$store->name = $request->name;
			$store->type_id = $request->type_id;
			$store->description = $request->description;
			$store->alias = $request->alias;
			$store->plan_id = 1;

			$store->save();

			/** Agrego el perfil del store */

			$storeInfo = new StoreProfile();
			$storeInfo->store_id = $store->id;

			$storeInfo->save();

			/** Agrego el shop / tienda del store */

			$storeShop = new StoreShop();
			$storeShop->store_id = $store->id;

			$storeShop->save();

			/** Agrego el usuario actual como administrador */

			$admin = new StoreAdmin();
			$admin->store_id = $store->id;
			$admin->user_id = \Auth::user()->id;
			$admin->role_id = 1;
			$admin->status = 1;

			$admin->save();


			return redirect()->route('store.home', [
				'alias' => $store->alias
			])->with(['message'=>'welcome']);

		} else {

			return redirect()->route('login');

		}

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
	public function update(Request $request){

		$validate = $this->validate($request, [
			'name' => 'required|min:6|max:50|string',
			'type_id' => 'required|integer',
			'description' => '',
			'alias' => 'required|min:6|max:30|unique:stores,alias,'.$request->store_id
		]);
		
		$store = Store::find($request->store_id);
		$store->name = $request->name;
		$store->type_id = $request->type_id;
		$store->description = $request->description;
		$store->alias = $request->alias;

		$store->save();

		return redirect()->route('store.edit', [
			'alias' => $store->alias
		])->with(['message'=>'Los cambios se guardaron con éxito.']);

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
	public function updateData(Request $request){
		
		$validate = $this->validate($request, [
			'store_id' => 'required|integer'
		]);
		
		$profile = StoreProfile::where('store_id', $request->store_id)->first();

		$profile->email = $request->email;
		$profile->website = $request->website;
		$profile->phone = $request->phone;
		$profile->cellphone = $request->cellphone;
		$profile->facebook = $request->facebook;
		$profile->instagram = $request->instagram;
		$profile->pinterest = $request->pinterest;
		
		$profile->save();

		return redirect()->route('store.data', [
			'alias' => $profile->store->alias
		])->with(['message'=>'Los cambios se guardaron con éxito.']);

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
