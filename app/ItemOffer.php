<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOffer extends Model {
    
	protected $table = 'items_offers';

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }

}
