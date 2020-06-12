<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model {
    
    protected $table = 'help_categories';

    public function topics(){
        return $this->hasMany('App\HelpTopic', 'category_id');
    }

}
