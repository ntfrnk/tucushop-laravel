<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller{
    
    /* Seleccionar forma de envío
	---------------------------------------------------- */
    public function shipping(){

        if(\Auth::user()){

            $total_price = 0;

            if(session('cart')){
                $items = session('cart');
                foreach($items as $item) {
                    $total_price += $item['price'] * $item['cant'];
                }
            } else {
                $items = 0;
            }        

            return view('sale.shipping', [
                'items' => $items,
                'total_price' => $total_price
            ]);
        
        } else {

            return redirect()->route('home');

        }

    }


    /* Seleccionar medio de pago
	---------------------------------------------------- */
    public function shippingSave(Request $request){

        session()->push('sale', array(
            'amount' => $request->amount,
            'deliveryType' => $request->delivery,
            'deliveryPrice' => $request->deliveryPrice,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postalcode' => $request->postalcode
        ));

        return redirect()->route('sale.payment');

    }


    /* Seleccionar medio de pago
	---------------------------------------------------- */
    public function payment(){

        if(\Auth::user()){

            foreach(session('sale') as $sale);

            return view('sale.payment', [
                'sale' => $sale
            ]);

        } else {

            return redirect()->route('home');

        }

    }

}
