<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class dashBoardCallflex extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($assunto, $email,$nome,$codigo)
    {
        $this->subject($assunto);
        $this->to($email,$nome);
        return $this->view('mail.code',['Codigo' => $codigo]);
    }
}
