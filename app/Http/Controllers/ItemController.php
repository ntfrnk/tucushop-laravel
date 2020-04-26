<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller {
    
	public function detail($id){

		return view('item.detail', [
			'param' => 'Parámetro de prueba'
		]);

	}

}
