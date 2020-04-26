<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

	protected $table = 'stores';

	// Negocios
    public function getAll(){
        return $this->hasMany('App\Stores');
    }

    // Locaciones
	public function locations(){
		return $this->hasMany('App\Location');
	}

	// Items
	public function items(){
		return $this->hasMany('App\Item');
	}

	// Admininistradores
	public function admins(){
		return $this->hasMany('App\StoreAdmin');
	}

	// El perfil
	public function profile(){
        return $this->hasOne('App\StoreProfile');
    }

    // El shop o tienda
    public function shop(){
        return $this->hasOne('App\Shop');
    }

    // El plan contratado
    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    // El tipo de negocio
    public function type(){
        return $this->belongsTo('App\Type');
    }

}

?>