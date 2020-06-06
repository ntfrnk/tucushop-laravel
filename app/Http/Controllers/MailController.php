<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\UserRecover;
use App\Store;
use App\Message;
use App\ItemReport;
use App\Question;
use App\Bug;

class MailController extends Controller {


    /*
    |
    | USUARIO
    | :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    */

    
    /* Bienvenida de usuario
	---------------------------------------------------- */
    public function userWelcome($user_id, $debug = false) {

        $user = User::find($user_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'user_welcome';
        $infoMail->gender = $user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = '¡Bienvenid'.$infoMail->gender.' a Red Tucushop!';
        $infoMail->user = $user;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Recuperación de contraseña (envío de código)
	---------------------------------------------------- */
    public function userRecoverPass($user_id, $debug = false) {

        $user = User::find($user_id);

        $recover = new UserRecover();
        $recover->user_id = $user->id;
        $recover->code = mt_rand(111111,999999);
        $recover->confirm = 0;
        $recover->save();

        $infoMail = new \stdClass();
        $infoMail->template = 'user_recoverpass';
        $infoMail->gender = $user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = 'Recupera tu contraseña';
        $infoMail->user = $user;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('user.pass.code', ['user_token' => $user->remember_token]);
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Recuperación de contraseña (cambio exitoso)
	---------------------------------------------------- */
    public function userChangePass($user_id, $debug = false) {

        $user = User::find($user_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'user_changepass';
        $infoMail->subject = 'Contraseña modificada';
        $infoMail->user = $user;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('login')
            ->with(['message' => '¡La contraseña se modificó exitosamente!<br>Por favor inicia sesión.']);
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Nuevo mensaje o respuesta
	---------------------------------------------------- */
    public function userNewMessage($message_id, $debug = false) {

        $message = Message::find($message_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'user_newmessage';
        $infoMail->gender = $message->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = $message->user->profile->name.', tu consulta por un artículo fue respondida';
        $infoMail->message = $message;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /*
    |
    | NEGOCIOS
    | :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    */
    
    /* Nuevo negocio (Bienvenida)
	---------------------------------------------------- */
    public function storeNew($store_id, $debug = false) {

        $store = Store::find($store_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_new';
        $infoMail->subject = '¡Creaste tu negocio en Red Tucushop!';
        $infoMail->store = $store;
 
        if($debug==false){
            Mail::to($store->user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Habilitación / deshabilitación de negocio
	---------------------------------------------------- */
    public function storeStatusChange($store_id, $debug = false) {

        $store = Store::find($store_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_statuschange';
        $infoMail->gender = $store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = $store->admins->first()->user->profile->name.', deshabilitaste tu negocio en Red Tucushop';
        $infoMail->store = $store;
 
        if($debug==false){
            Mail::to($store->user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Eliminación de negocio
	---------------------------------------------------- */
    public function storeDelete($store_id, $debug = false) {

        $store = Store::find($store_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_delete';
        $infoMail->gender = $store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = $store->admins->first()->user->profile->name.', eliminaste tu negocio en Red Tucushop';
        $infoMail->store = $store;
 
        if($debug==false){
            Mail::to($store->user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Nuevo mensaje o respuesta
	---------------------------------------------------- */
    public function storeNewMessage($message_id, $debug = false) {

        $message = Message::find($message_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_newmessage';
        $infoMail->gender = $message->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = 'Recibiste una consulta por un artículo';
        $infoMail->message = $message;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Denuncia de un artículo
	---------------------------------------------------- */
    public function storeClaim($claim_id, $debug = false) {

        $report = ItemReport::find($claim_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_claim';
        $infoMail->gender = $report->item->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = 'Uno de tus artículos fue denunciado';
        $infoMail->report = $report;
 
        if($debug==false){
            Mail::to($user->email)->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /*
    |
    | ROOT (internos)
    | :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    */


    /* Aviso de nuevo usuario
	---------------------------------------------------- */
    public function rootNewUser($user_id, $debug = false) {

        $user = User::find($user_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_newuser';
        $infoMail->subject = 'Nuevo usuario en Tucushop';
        $infoMail->user = $user;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Aviso de nuevo negocio
	---------------------------------------------------- */
    public function rootStoreNew($store_id, $debug = false) {

        $store = Store::find($store_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_newstore';
        $infoMail->subject = 'Nuevo negocio creado en Red Tucushop';
        $infoMail->store = $store;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Aviso de negocio eliminado
	---------------------------------------------------- */
    public function rootStoreDeleted($store_id, $debug = false) {

        $store = Store::find($store_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_storedeleted';
        $infoMail->subject = 'Negocio eliminado en Red Tucushop';
        $infoMail->store = $store;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Denuncia de un artículo
	---------------------------------------------------- */
    public function rootClaim($claim_id, $debug = false) {

        $report = ItemReport::find($claim_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_claim';
        $infoMail->subject = 'Artículo denunciado en Tucushop.com';
        $infoMail->report = $report;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Consulta desde la página
	---------------------------------------------------- */
    public function rootQuestion($question_id, $debug = false) {

        $question = Question::find($question_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_question';
        $infoMail->subject = 'Consulta realizada desde Tucushop.com';
        $infoMail->question = $question;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


    /* Reporte de un error desde la página
	---------------------------------------------------- */
    public function rootReporting($reporting_id, $debug = false) {

        $bug = Bug::find($reporting_id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_reporting';
        $infoMail->subject = 'Reporte de error en Tucushop.com';
        $infoMail->bug = $bug;
 
        if($debug==false){
            Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
            return redirect()->route('');
        } else {
            return view('mail.'.$infoMail->template, ['info' => $infoMail]);
        }

    }


}
