<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreShop extends Model {
    
	protected $table = 'stores_shop';

    // Store
    public function store(){
        return $this->belongsTo('App\Store');
    }

}
