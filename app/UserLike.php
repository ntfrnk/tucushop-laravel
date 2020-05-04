<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model {
    
	protected $table = 'users_likes';

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function item(){
		return $this->belongsTo('App\Item');
	}

}
