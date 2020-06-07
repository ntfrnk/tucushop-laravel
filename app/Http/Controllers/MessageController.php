<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

use App\Message;
use App\MessageAnswer;
use App\Store;
use App\Item;
use App\Email;

class MessageController extends Controller {
    

    /* Bandeja de entrada de usuario
	---------------------------------------------------- */
	public function user(){
		
		if(\Auth::user()){

			$user = \Auth::user();
			$messages = Message::
				where('user_id', $user->id)
				->where('closed', 0)
				->with(['answers' => function($query) {
					$query->orderBy('readed', 'asc');
				}])
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
						->orderBy('readed', 'asc')
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

		$newmsj = new Message();
		$newmsj->user_id = $user->id;
		$newmsj->item_id = $item->id;
		$newmsj->store_id = $item->store->id;
		$newmsj->content = $request->content;
		$newmsj->closed = 0;

		$newmsj->save();

		// Envío la notificación al dueño del store

		$message = Message::find($newmsj->id);

		$infoMail = new \stdClass();
        $infoMail->template = 'store_newmessage';
        $infoMail->gender = $message->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = 'Recibiste una consulta por un artículo';
		$infoMail->message = $message;
		
		$mail = new Email();
		$mail->topic = 'New message to store';
		$mail->save();
 
        Mail::to($message->store->admins->first()->user->email)->send(new MailSender($infoMail));
		
		return "ok";

	}


    /* Leer mensaje (user)
	---------------------------------------------------- */
	public function readUser($message_id){
		
		if(\Auth::user()){

			$message = Message::find($message_id);
			$user = \Auth::user();

			return view('user.modules.message_read', [
				'message' => $message,
				'user' => $user
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Leer mensaje
	---------------------------------------------------- */
	public function readStore($alias, $message_id){
		
		if(\Auth::user()){

			$message = Message::find($message_id);
			$store = Store::find($message->store->id);

			if($message->readed_at == "0000-00-00 00:00:00"){
				$message->readed_at = date('Y-m-d H:i:s');
				$message->save();
			}

			return view('store.modules.message_read', [
				'message' => $message,
				'store' => $store
			]);

		} else {

			return redirect()->route('home');

		}

	}
	

	/* Respuesta a un mensaje
	---------------------------------------------------- */
	public function answer(Request $request){

		if(\Auth::user()){

			$validate = $this->validate($request, [
				'store_id' => 'integer|required',
				'message_id' => 'integer|required',
				'sended_by' => 'alpha|required|min:4|max:5',
				'content' => 'string|min:10'
			], [
				'store_id.integer' => 'Uno de los datos enviados no es correcto',
				'store_id.required' => 'Falta uno de los datos requeridos',
				'message_id.integer' => 'Uno de los datos enviados no es correcto',
				'message_id.required' => 'Falta uno de los datos requeridos',
				'sended_by.alpha' => 'Uno de los datos enviados no es correcto',
				'sended_by.required' => 'Falta uno de los datos requeridos',
				'sended_by.min' => 'Uno de los datos enviados no es correcto',
				'sended_by.max' => 'Uno de los datos enviados no es correcto',
				'content.string' => 'Estás ingresando uno o más caracteres no permitidos',
				'content.min' => 'La respuesta enviada es demasiado corta'
			]);

			$user = \Auth::user();

			$answer = new MessageAnswer();
			$answer->user_id = $user->id;
			$answer->message_id = $request->message_id;
			$answer->store_id = $request->store_id;
			$answer->content = $request->content;
			$answer->sended_by = $request->sended_by;

			$answer->save();

			if($request->sended_by == 'user'){

				// Envío notificación por mail

				$message = Message::find($request->message_id);

				$infoMail = new \stdClass();
				$infoMail->template = 'store_newanswer';
				$infoMail->gender = $message->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
				$infoMail->subject = 'Tienes un nuevo mensaje en una consulta que te hicieron';
				$infoMail->message = $message;

				$mail = new Email();
				$mail->topic = 'New answer to store';
				$mail->save();

				Mail::to($user->email)->send(new MailSender($infoMail));
			
				return redirect()->route('user.message.read', [
					'message_id' => $request->message_id
				]);

			} else {

				// Envío notificación por mail

				$message = Message::find($request->message_id);

				$infoMail = new \stdClass();
				$infoMail->template = 'user_newanswer';
				$infoMail->gender = $message->user->profile->gender == 'Masculino' ? 'o' : 'a';
				$infoMail->subject = $message->user->profile->name.', tienes un nuevo mensaje en una consulta que hiciste';
				$infoMail->message = $message;

				$mail = new Email();
				$mail->topic = 'New answer to user';
				$mail->save();

				Mail::to($message->store->admins->first()->user->email)->send(new MailSender($infoMail));

				$store = Store::find($request->store_id);

				return redirect()->route('store.message.read', [
					'message_id' => $request->message_id,
					'store' => $store
				]);

			}

		} else {

			return redirect()->route('home');

		}

	}


	/* Gestión de mensajes (Bandeja de entrada)
	---------------------------------------------------- */
	public function delete($message_id){
		
		if(\Auth::user()){

			$message = Message::find($message_id);
            $message->closed = 1;
            $message->save();

			return redirect()->route('user.messages');

		} else {

			return redirect()->route('home');

		}

    }


}
