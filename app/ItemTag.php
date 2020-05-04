<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model{
    
	protected $table = 'items_tags';

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }

    // Keyword
    public function keyword(){
        return $this->belongsTo('App\Keyword');
    }

}
