<?php

namespace App\Mail;

use App\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var App\Content
     */
    public $newsletter;

    /**
     * @var string
     */
    public $intro;

    /**
     * @return void
     */
    public function __construct(Content $newsletter, $attributes)
    {
        $this->subject($attributes['subject']);
        $this->replyTo($attributes['replyTo']);

        $this->newsletter = $newsletter;
        $this->intro = $attributes['intro'];
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newsletter');
    }
}
