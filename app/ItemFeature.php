<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemFeature extends Model{
    
	protected $table = 'items_features';

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }

    // Feature
    public function feature(){
        return $this->belongsTo('App\Feature');
    }

}
