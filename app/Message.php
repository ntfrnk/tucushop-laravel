<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $table = 'messages';

    // Respuestas
    public function answers(){
        return $this->hasMany('App\MessageAnswer');
    }
    
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