<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Store;
use App\StoreAdmin;
use App\StoreShop;
use App\StoreProfile;

class ShopController extends Controller {
    
    /* Portada del e-shop o tienda
	---------------------------------------------------- */
	public function home($alias){
        
        if(\Help::exists($alias) && !\Help::isDeleted($alias) && \Help::isActive($alias)){

            $store = Store::where('alias', $alias)->first();
            $items = Item::where('store_id', $store->id)->paginate(12);

			return view('shop.home', [
				'store' => $store,
				'items' => $items
				]);

		} else {

			return redirect()->route('home');

		}

	}

}
