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

    public $attendances;

    public function __construct(attendances $attendance)
    {
        $this->attendances = $attendances;
    }




     
    public function build()
    {
        return $this->from('ahsan.anis@xoopr.io')
        ->view('my-email');
        return;
    }
}