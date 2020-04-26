<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $table = 'messages';

    // Store
    public function store(){
        return $this->belongsTo('App\Store');
    }

    // User
    public function user(){
        return $this->belongsTo('App\User');
    }

    // Item
    public function item(){
        return $this->belongsTo('App\Item');
    }

}

?>