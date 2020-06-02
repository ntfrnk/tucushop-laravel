<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

use App\User;

class MailController extends Controller {
    
    public function toUser($user_id) {

        $user = User::find($user_id);

        $infoMail = new \stdClass();
        $infoMail->sender = 'Equipo Tucushop';
        $infoMail->user = $user;
 
        Mail::to($user->email)->send(new MailSender($infoMail));

    }

    public function ver() {

        $user = \Auth::user();

        $infoMail = new \stdClass();
        $infoMail->sender = 'Equipo Tucushop';
        $infoMail->user = $user;
 
        Mail::to($user->email)->send(new MailSender($infoMail));

        return view('mail.store_new', ['info' => $infoMail]);

    }

}
