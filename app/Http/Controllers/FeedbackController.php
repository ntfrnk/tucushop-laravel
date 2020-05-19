<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Bug;
use App\Question;
use App\ItemReport;

class FeedbackController extends Controller {
    
    /* Reportar un bug en la página
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


    /* Enviar una consulta sobre la página
    ---------------------------------------------------- */
    public function question(Request $request){

        $question = new Question();
        $question->name = $request->name;
        $question->contact = $request->contact;
        $question->content = $request->content;

        $question->save();

        return "ok";

    }


    /* Enviar una consulta sobre la página
    ---------------------------------------------------- */
    public function problem(Request $request){

        $problem = new ItemReport();
        $problem->item_id = $request->item_id;
        $problem->reason = $request->reason;
        $problem->content = $request->content;

        $problem->save();

        return "ok";

    }

}
