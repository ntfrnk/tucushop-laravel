<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';

    // Detalles del item
	public function features(){
		return $this->hasMany('App\Feature');
	}

	// Fotos
	public function photos(){
		return $this->hasMany('App\Photo');
	}

	// Likes
	public function likes(){
		return $this->hasMany('App\Like');
	}

    // El shop o tienda
    public function messages(){
        return $this->hasMany('App\Message');
    }

	// Ofertas
	public function offers(){
		return $this->hasOne('App\Offer');
	}

    // Negocio
    public function store(){
        return $this->belongsTo('App\Store');
    }

}

?>