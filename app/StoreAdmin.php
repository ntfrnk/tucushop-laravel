<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAdmin extends Model {

	protected $table = 'stores_admins';

    // Usuario
	public function user(){
		return $this->belongsTo('App\User');
	}

	// Store
	public function store(){
		return $this->belongsTo('App\Store');
	}

	// Store
	public function role(){
		return $this->belongsTo('App\Role');
	}

}

?>