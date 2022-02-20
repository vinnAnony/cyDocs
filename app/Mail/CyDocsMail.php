<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CyDocsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $document;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param $document
     * @param $user
     */
    public function __construct($document, $user)
    {
        $this->document = $document;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('CyDocs File Access Update')
            ->markdown('mails.twelve-hours-notification',[
            'document' => $this->document,
            'user' => $this->user
        ]);
    }
}
