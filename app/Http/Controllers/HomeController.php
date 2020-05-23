<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Item;
use App\ItemOffer;

class HomeController extends Controller {

    public function index() {

        /* echo public_path();
        die; */

        $offers = ItemOffer::
        whereHas('item', function(Builder $query){
            $query->where(function($query) {
                $query->where('status', 1);
                $query->whereHas('store', function($q) {
                    $q->where('status', 1);
                    $q->where('deleted', '!=', 1);
                });
            });
        })
        ->inRandomOrder()
        ->take(8)
        ->get();

        $items_dest = Item::
            where(function($query) {
                $query->where('status', 1);
                $query->whereHas('store', function($q) {
                    $q->where('status', 1);
                    $q->where('deleted', '!=', 1);
                });
            })
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('home', [
            'offers' => $offers,
            'items_dest' => $items_dest
        ]);

    }
}
