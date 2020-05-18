<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller {
    
    /* Políticas de privacidad
	---------------------------------------------------- */
    public function policy(){

        return view('page.policy');

    }


    /* Términos y condiciones de uso
	---------------------------------------------------- */
    public function terms(){

        return view('page.terms');

    }

}
