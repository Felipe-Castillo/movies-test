<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MovieEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $movie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($movie)
    {
        $this->movie=$movie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.emails.movie',compact('movie'));
    }
}
