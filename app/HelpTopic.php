<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpTopic extends Model {
    
    protected $table = 'help_topics';

    public function category(){
        return $this->belongsTo('App\HelpCategory');
    }

}
