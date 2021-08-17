<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\PDF;

class RecetaMMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="Receta Médica";
    public $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.receta')->attachData($this->pdf, 'receta.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
