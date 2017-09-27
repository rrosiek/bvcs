<?php

namespace App\Jobs;

use App\Member;
use App\Mail\Correspondence;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ProcessMailing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @return void
     */
    public function __construct($attributes)
    {
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
            Mail::to($r)->send(new Correspondence($this->attributes));
    }
}
