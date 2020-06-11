<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;

use App\Bug;
use App\Question;
use App\ItemReport;
use App\Email;

class FeedbackController extends Controller {
    
    /* Reportar un bug en la página
    ---------------------------------------------------- */
    public function bugs(Request $request){

        $bug = new Bug();
        $bug->name = $request->name;
        $bug->whereis = $request->whereis;
        $bug->url = $request->url;
        $bug->content = $request->content;

        $bug->save();

        // Notifico a root

        $newBug = Bug::find($bug->id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_reporting';
        $infoMail->subject = 'Reporte de error en Tucushop.com';
        $infoMail->bug = $newBug;
 
        Mail::to('info@tucushop.com')->send(new MailSender($infoMail));

        $mail = new Email();
		$mail->topic = 'Bug reporting';
        $mail->save();

        return "ok";

    }


    /* Enviar una consulta sobre la página
    ---------------------------------------------------- */
    public function question(Request $request){

        $question = new Question();
        $question->name = $request->name;
        $question->contact = $request->contact;
        $question->content = $request->content;

        $question->save();


        // Notifico a root

        $newquestion = Question::find($question->id);

        $infoMail = new \stdClass();
        $infoMail->template = 'root_question';
        $infoMail->subject = 'Consulta realizada desde Tucushop.com';
        $infoMail->question = $newquestion;
 
        Mail::to('info@tucushop.com')->send(new MailSender($infoMail));

        $mail = new Email();
		$mail->topic = 'Question from page';
        $mail->save();

        return "ok";

    }


    /* Reportar un problema con un artículo
    ---------------------------------------------------- */
    public function problem(Request $request){

        $problem = new ItemReport();
        $problem->item_id = $request->item_id;
        $problem->reason = $request->reason;
        $problem->content = $request->content;

        $problem->save();
        

        // Notifico al dueño del negocio

        $report = ItemReport::find($problem->id);

        $infoOwner = new \stdClass();
        $infoOwner->template = 'store_claim';
        $infoOwner->gender = $report->item->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoOwner->subject = 'Uno de tus artículos fue denunciado';
        $infoOwner->report = $report;

        Mail::to($report->item->store->admins->first()->user->email)->send(new MailSender($infoOwner));

        $mail = new Email();
		$mail->topic = 'Item reported (to owner)';
        $mail->save();
        
        
        // Notifico a root

        $infoRoot = new \stdClass();
        $infoRoot->template = 'root_claim';
        $infoRoot->subject = 'Artículo denunciado en Tucushop.com';
        $infoRoot->report = $report;

        Mail::to('info@tucushop.com')->send(new MailSender($infoRoot));
        
        $mail = new Email();
		$mail->topic = 'Item reported (to root)';
        $mail->save(); 

        return "ok";

    }

}
