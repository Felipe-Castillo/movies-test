<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MovieEmail;
use App\Models\Movie;

use Mail;

class MovieEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;
    protected $movie_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail, $movie_id)
    {
        $this->send_mail = $send_mail;
        $this->movie_id = $movie_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $m=Movie::find($this->movie_id);
    try {
        Mail::to($this->send_mail)->send(new MovieEmail($m));
    }
    catch(Exception $e) {
        $this->failed($e);
    }
      
    }

public function failed($exception)
{
    $exception->getMessage();
    // etc...
}

}
