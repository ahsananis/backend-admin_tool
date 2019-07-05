<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class my-email extends Mailable
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('my-email');
    }
}