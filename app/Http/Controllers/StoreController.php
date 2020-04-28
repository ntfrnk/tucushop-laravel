<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller {
    
	public function index(){
		echo "Portada del store";
	}

	public function list(){
		echo "Listado de stores propios";
	}

	public function home(){
		echo "Portada de administración del store";
	}

	public function new(){
		echo "Agregar un store";
	}

	public function save(){
		// Guardado de nuevo store
	}

	public function edit(){
		echo "Edición de datos generales del store";
	}

	public function update(){
		// Guardado de datos editados
	}

	public function shopConfig(){
		echo "Configuración del eshop";
	}

	public function shopConfigSave(){
		// Guardado de configuraciones del shop
	}

	public function admins(){
		echo "Gestión de administradores";
	}

	public function newAdmin(){
		echo "Formulario de nuevo administrador";
	}

	public function saveAdmin(){
		// Guardado de nuevo administrador
	}

	public function editAdmin(){
		echo "Edición de administrador";
	}

	public function updateAdmin(){
		// Guardado de cambios del administrador
	}

	public function messages(){
		echo "Listado de mensajes";
	}

	public function changeStatus(){
		// Cambio de estado (Activo / inactivo)
	}

	public function delete(){
		// No se elimina, sólo se marca la casilla "deleted"
	}

}
