<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model {
    
	protected $table = 'users_addresses';

	public function user(){
		return $this->belongsTo('App\User');
	}

}
