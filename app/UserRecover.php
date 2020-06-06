<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRecover extends Model {
    
    protected $table = 'users_recoverpass';

	public function user(){
		return $this->belongsTo('App\User');
	}

}
