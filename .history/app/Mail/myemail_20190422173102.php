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

    public $emp_att;

    public function __construct(emp_att $emp_att)
    {
        $this->emp_att = $emp_att;
    }




     
    public function build()
    {
        return $this->from('ahsan.anis@xoopr.io')
        ->view('my-email');
        return;
    }
}