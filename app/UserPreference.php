<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model {
    
	protected $table = 'users_preferences';

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function keyword(){
		return $this->belongsTo('App\Keyword');
	}

}
