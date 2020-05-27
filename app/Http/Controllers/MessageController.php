<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Store;
use App\Item;

class MessageController extends Controller {
    

    /* Bandeja de entrada de usuario
	---------------------------------------------------- */
	public function user(){
		
		if(\Auth::user()){

			$user = \Auth::user();
			$messages = Message::
				where('user_id', $user->id)
				->where('closed', 0)
				->orderBy('Id', 'desc')
				->paginate(5);

			return view('user.modules.messages', [
				'user' => $user,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('home');

		}

    }


    /* Bandeja de entrada de store
	---------------------------------------------------- */
	public function store($alias){
		
		if(\Auth::user() && \Help::exists($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$messages = Message::where('store_id', $store->id)
						->orderBy('Id', 'desc')
						->paginate(5);

			return view('store.modules.messages', [
				'store' => $store,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('store.list');

		}

	}
    

    /* Consulta sobre un item
	---------------------------------------------------- */
	public function send(Request $request){

		$user = \Auth::user();
		$item = Item::find($request->item_id);

		$message = new Message();
		$message->user_id = $user->id;
		$message->item_id = $item->id;
		$message->store_id = $item->store->id;
		$message->content = $request->content;
		$message->closed = 0;

		$message->save();
		
		return "ok";

	}


	/* Gestión de mensajes (Bandeja de entrada)
	---------------------------------------------------- */
	public function delete($message_id){
		
		if(\Auth::user()){

			$message = Message::find($message_id);
            $message->closed = 1;
            $message->save();

			return view('user.modules.messages', [
				'user' => $user,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('home');

		}

    }


    /* Gestión de mensajes (Bandeja de entrada)
	---------------------------------------------------- */
	public function read($message_id){
		
		if(\Auth::user()){

			$message = Message::find($message_id);

			return view('user.modules.message_read', [
				'user' => $user,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('home');

		}

    }


}
