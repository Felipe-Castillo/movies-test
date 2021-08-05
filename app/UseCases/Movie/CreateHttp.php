<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;

class CreateHttp
{
    private $movie;


    public function __construct(
        Movie $movie

    )
    {
        $this->movie = $movie;

    }

    public function execute($data)
    {
    $publication_date=Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d');



    foreach ($data["results"] as $key => $value) 
    {


      $movie = $this->movie->create(["name"=>$value["name"],"publication_date"=>$publication_date,"status"=>1,"genre_id"=>1]);
       
    }
  




      return $movie;
    }


   
}