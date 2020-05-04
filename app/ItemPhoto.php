<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model {
    
	protected $table = 'items_photos';

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }
    
}
