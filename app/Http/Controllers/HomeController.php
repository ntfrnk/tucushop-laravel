<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemOffer;

class HomeController extends Controller {

    public function index() {

        $offers = ItemOffer::inRandomOrder()
        				->take(8)
        				->get();

        $items_dest = Item::where('status', '1')
                        ->inRandomOrder()
                        ->take(8)
                        ->get();

        return view('home', [
            'offers' => $offers,
            'items_dest' => $items_dest
        ]);

    }
}
