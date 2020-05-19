<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Bug;

class FeedbackController extends Controller {
    
    /* Listado de items
    ---------------------------------------------------- */
    public function bugs(Request $request){

        $bug = new Bug();
        $bug->name = $request->name;
        $bug->whereis = $request->whereis;
        $bug->url = $request->url;
        $bug->content = $request->content;

        $bug->save();

        return "ok";

    }

}
