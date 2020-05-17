<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class CartController extends Controller {
    
    /* Agregar un item al carrito de compras
	---------------------------------------------------- */
	public function items(){

		if(\Auth::user()){

			if(session('cart')){
				$items = session('cart');
			} else {
				$items = 0;
			}
			
			return view('cart.items', [
				'items' => $items
			]);

		} else {

            return redirect()->route('home');

        }

    }


    /* Agregar un item al carrito de compras
	---------------------------------------------------- */
	public function add(int $item_id){

		$user = \Auth::user();

		$new_item = 1;

		if(session('cart')){
			foreach(session('cart') as $sess){
				if($sess['id'] == $item_id){
					$new_item = 0;
				}
			}
		}

		if($new_item == 1){

			$item = Item::where('id', $item_id)->first();

			if(!empty($item->offer->price)){
				$price = $item->offer->price;
			} else {
				$price = $item->price;
			}

			session()->push('cart',
				array(
					'id' => $item->id,
					'name' => $item->name,
					'price' => $price,
					'image' => $item->photos->sortBy('ordering')->first()->file_path,
					'cant' => 1
				)
			);

			$resp = 1;
			
		} else {

			$cart = session('cart');

			session()->forget('cart');

			foreach($cart as $item){
				if($item['id'] != $item_id){
					$new_cart[] = $item;
				}
			}

			if(!empty($new_cart)){
				session(['cart' => $new_cart]);
			}

			$resp = 0;
			
		}
		
		return $resp;

	}
	

	/* Limpiar el carrito de compras
	---------------------------------------------------- */
	public function increase($item_id){

        $cart = session('cart');

		session()->forget('cart');

		foreach($cart as $item){
			if($item['id'] == $item_id){
				$new_cant = $item['cant'] + 1;
				$new_cart[] = [
					'id' => $item['id'],
					'name' => $item['name'],
					'price' => $item['price'],
					'image' => $item['image'],
					'cant' => $new_cant
				];
			} else {
				$new_cart[] = $item;
			}
		}

		session(['cart' => $new_cart]);

		return $new_cant;

	}
	

	/* Limpiar el carrito de compras
	---------------------------------------------------- */
	public function decrease($item_id){

        $cart = session('cart');

		session()->forget('cart');

		foreach($cart as $item){
			if($item['id'] == $item_id){
				if($item['cant']!=1){
					$new_cant = $item['cant'] - 1;
					$new_cart[] = [
						'id' => $item['id'],
						'name' => $item['name'],
						'price' => $item['price'],
						'image' => $item['image'],
						'cant' => $new_cant
					];
				} else {
					$new_cant = 0;
				}
			} else {
				$new_cart[] = $item;
			}
		}

		session(['cart' => $new_cart]);

		return $new_cant;

    }
    

    /* Limpiar el carrito de compras
	---------------------------------------------------- */
	public function clean(){

        session()->pull('cart');

        return redirect()->route('cart.items');

    }

}
