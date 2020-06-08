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
 
        Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));

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
 
        Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));

        $mail = new Email();
		$mail->topic = 'Question from page';
        $mail->save();

        return "ok";

    }


    /* Enviar una consulta sobre la página
    ---------------------------------------------------- */
    public function problem(Request $request){

        $problem = new ItemReport();
        $problem->item_id = $request->item_id;
        $problem->reason = $request->reason;
        $problem->content = $request->content;

        $problem->save();


        // Notifico al dueño del negocio

        $report = ItemReport::find($problem->id);

        $infoMail = new \stdClass();
        $infoMail->template = 'store_claim';
        $infoMail->gender = $report->item->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a';
        $infoMail->subject = 'Uno de tus artículos fue denunciado';
        $infoMail->report = $report;
 
        Mail::to($report->item->store->admins->first()->user->email)->send(new MailSender($infoMail));

        $mail = new Email();
		$mail->topic = 'Item reported (to owner)';
        $mail->save();
        
        
        // Notifico a root

        $infoMail = new \stdClass();
        $infoMail->template = 'root_claim';
        $infoMail->subject = 'Artículo denunciado en Tucushop.com';
        $infoMail->report = $report;

        Mail::to('mailing@tucushop.com')->send(new MailSender($infoMail));
        
        $mail = new Email();
		$mail->topic = 'Item reported (to root)';
        $mail->save();

        return "ok";

    }

}
