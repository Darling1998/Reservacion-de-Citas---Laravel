<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $s;
    public $s1;
    public $s2;

    public function __construct($st1, $st2)
    {
        $this->s=$st1;
        $this->s1=$st2;
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.avisocm');
    }
}
