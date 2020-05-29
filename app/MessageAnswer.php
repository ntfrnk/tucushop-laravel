<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageAnswer extends Model {
    
    protected $table = 'messages_answers';

    public function message(){
        return $this->belongsTo('App\Message');
    }

    // Store
    public function store(){
        return $this->belongsTo('App\Store');
    }

    // User
    public function user(){
        return $this->belongsTo('App\User');
    }

}
