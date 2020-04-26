<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model {
    
	protected $table = 'stores_locations';

    // Item
    public function store(){
        return $this->belongsTo('App\Store');
    }

}
