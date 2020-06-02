<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSender extends Mailable {

    use Queueable, SerializesModels;

    public $info;
 
    public function __construct($info) {
        $this->info = $info;
    }

    public function build() {
        return $this->from('mailing@tucushop.com')
        ->view('mails.demo')
        ->text('mails.demo_plain')
        ->with(
            [
                'testVarOne' => '1',
                'testVarTwo' => '2',
            ])
            ->attach(public_path('/images').'/demo.jpg', [
                    'as' => 'demo.jpg',
                    'mime' => 'image/jpeg',
            ]);
    }

}
