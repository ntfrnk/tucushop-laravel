<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemReport extends Model{
    
	protected $table = 'items_report';

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }

}
