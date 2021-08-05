<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use App\Models\Genre;
use App\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;

class CreateHttp
{
    private $movie;
    private $genre;
    private $user;


    public function __construct(
        Movie $movie,
        Genre $genre,
        User $user

    )
    {
        $this->movie = $movie;
        $this->genre = $genre;
        $this->user = $user;

    }

    public function execute($data)
    {
    $publication_date=Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d');


    $this->genre->firstOrCreate(["name"=>"Animacion"]);

    $this->user->firstOrCreate(["name"=>"test","email"=>"test@mail.com","password"=>bcrypt("12345")]);

    foreach ($data["results"] as $key => $value) 
    {


      $movie = $this->movie->create(["name"=>$value["name"],"publication_date"=>$publication_date,"status"=>1,"genre_id"=>1]);
       
    }
  




      return $movie;
    }


   
}