<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\Feature;
use App\Tag;
use App\ItemFeature;
use App\ItemTag;

class SearchController extends Controller {
    
    /* Busqueda general
	---------------------------------------------------- */
    public function do(Request $request){

        $validate = $this->validate($request, [
            'search' => 'string'
        ]);

        return redirect()->route('search.results', [
            'keyword' => $request->search
        ]);

    }
    
    
    /* Resultados de búsqueda
	---------------------------------------------------- */
    public function results($keyword){

        $words = explode(" ", $keyword);

        $items = Item::
            where(function($query) {
                $query->where('status', 1);
                $query->whereHas('store', function($q) {
                    $q->where('status', 1);
                    $q->where('deleted', '!=', 1);
                });
            })
            ->where(function($query) use ($words){
                foreach($words as $word){
                    $query->orWhere('name', 'like', '%'.$word.'%');
                    $query->orWhere('detail', 'like', '%'.$word.'%');
                    $query->orWhereHas('features', function($q) use ($word) {
                        $q->where('content', 'like', '%'.$word.'%');
                    });
                    $query->orWhereHas('tags', function($query) use ($word) {
                        $query->whereHas('keyword', function($q) use ($word) {
                            $q->where('keyword', 'like', '%'.$word.'%');
                        });
                    });
                }
            })
            ->paginate(12);

        $search = implode("» y «", $words);

        return view('search.results', [
            'items' => $items,
            'search' => $search
        ]);

    }

}
