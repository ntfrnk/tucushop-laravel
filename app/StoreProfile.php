<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model {
    
	protected $table = 'stores_profile';

    // Store
    public function store(){
        return $this->belongsTo('App\Store');
    }

}
