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
        ->view('mail.'.$this->info->template);
    }

}
