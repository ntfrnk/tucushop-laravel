<?php

namespace App\Helpers;
  
use Illuminate\Support\Facades\DB;

use App\Item;
  
class PhotoItem {

	public static function first($item_id){

		$item = Item::find($item_id);

		$element = null;

		foreach($item->photos as $photo){
			$element[] = $photo->file_path;
		}
		
		return $element[0];

	}

}