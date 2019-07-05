<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class myemail extends Mailable
{
    /**
     * Build the message.
     *
     * @return $this
     */




     
    public function build()
    {
         $this->from('ahsan.anis@xoopr.io')
        ->view('myemail');
        return;
    }
}