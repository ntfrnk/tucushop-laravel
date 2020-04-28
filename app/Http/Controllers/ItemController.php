<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Item;

class ItemController extends Controller {
    
	public function detail($name, $id){

		$item = Item::find($id);
		$items_sugested = Item::where('status', '1')
							->inRandomOrder()
							->take(8)
							->get();

		return view('item.detail', [
			'item' => $item,
			'items_sugested' => $items_sugested
		]);

	}

}
