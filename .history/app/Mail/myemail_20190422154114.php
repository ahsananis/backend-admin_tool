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
        return $this->from('ahsan.anis@xoopr.io')
        ->view('my-email');
        return;
    }
}