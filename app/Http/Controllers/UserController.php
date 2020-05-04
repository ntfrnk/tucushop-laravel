<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    
	public function home(){
		
		$user = \Auth::user();

		return view('user.home', [
			'user' => $user
		]);

	}

}
