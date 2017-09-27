<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Correspondence extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $subjectForBody;

    /**
     * @return void
     */
    public function __construct($attributes)
    {
        $this->subject($attributes['subject']);
        $this->replyTo($attributes['replyTo']);

        $this->message = $attributes['message'];
        $this->subjectForBody = $attributes['subject'];
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.correspondence');
    }
}
