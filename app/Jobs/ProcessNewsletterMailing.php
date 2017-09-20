<?php

namespace App\Jobs;

use App\Content;
use App\Member;
use App\Mail\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ProcessNewsletterMailing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Content
     */
    protected $newsletter;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @return void
     */
    public function __construct(Content $newsletter, $attributes)
    {
        $this->newsletter = $newsletter;
        $this->attributes = $attributes;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $recipients = Member::where('subscribed', true)
            ->get()
            ->unique('email')
            ->pluck('email');

        foreach ($recipients as $r)
            Mail::to($r)->send(new Newsletter($this->newsletter, $this->attributes));
    }
}
