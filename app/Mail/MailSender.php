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
        return $this->view('mail.'.$this->info->template);
    }

}
