<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use App\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;
use App\Jobs\MovieEmailJob;

class Send
{
    private $movie;
    private $user;


    public function __construct(
        Movie $movie,
        User $user

    )
    {
        $this->movie = $movie;
        $this->user = $user;

    }

    public function execute(Request $request)
    {
  
     $email=$this->user->find($request->user_id)->email;

  
    dispatch(new MovieEmailJob($email,$request->movie_id));

    return $email;

    }


   
}