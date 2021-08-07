<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject="Recomendaciones";
    public $info;
 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( array $data)
    {
        $this->info=array();
        $this->info=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.aviso');
    }
}
