<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\HelpCategory;
use App\HelpTopic;

class HelpController extends Controller {
    
    /* Home del Centro de ayuda
	---------------------------------------------------- */
    public function index(){

        $categories = HelpCategory::where('active', 1)->orderBy('ordering', 'asc')->get();

        return view('help.modules.index', [
            'categories' => $categories
        ]);

    }


    /* Categoría en centro de ayuda
	---------------------------------------------------- */
    public function category($name, $id){

        $categories = HelpCategory::where('active', 1)->orderBy('ordering', 'asc')->get();
        $category = HelpCategory::find($id);

        return view('help.modules.category', [
            'categories' => $categories,
            'category' => $category
        ]);

    }


    /* Detalle de ayuda
	---------------------------------------------------- */
    public function detail($title, $id){

        $categories = HelpCategory::where('active', 1)->orderBy('ordering', 'asc')->get();
        $topic = HelpTopic::find($id);

        return view('help.modules.detail', [
            'categories' => $categories,
            'topic' => $topic
        ]);

    }


}
