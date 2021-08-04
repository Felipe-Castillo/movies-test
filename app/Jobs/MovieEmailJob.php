<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MovieEmail;
use Mail;

class MovieEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;
    protected $movie;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail,$movie)
    {
        $this->send_mail = $send_mail;
        $this->movie = $movie;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new MovieEmail($this->movie);        
        Mail::to($this->send_mail)->send($email);
    }
}
