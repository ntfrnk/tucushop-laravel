<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';

    // Detalles del item
	public function features(){
		return $this->hasMany('App\ItemFeature');
	}

	// Fotos
	public function photos(){
		return $this->hasMany('App\ItemPhoto');
	}

	// Likes
	public function likes(){
		return $this->hasMany('App\UserLike');
	}

	// Etiquetas
	public function tags(){
		return $this->hasMany('App\ItemTag');
	}

    // Mensajes
    public function messages(){
        return $this->hasMany('App\Message');
    }

	// Ofertas
	public function offer(){
		return $this->hasOne('App\ItemOffer');
	}

    // Negocio
    public function store(){
        return $this->belongsTo('App\Store');
    }

}

?>