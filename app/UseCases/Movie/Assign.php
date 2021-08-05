<?php

namespace App\UseCases\Movie;

use App\Models\Movie;

class Assign
{
    private $movie;


    public function __construct(
        Movie $movie

    )
    {
        $this->movie = $movie;

    }

    public function execute(array $data)
    {
        
        $movie = $this->movie->find($data["movie_id"]);

        foreach ($data["shift_ids"] as $key => $value) 
        {
           $movie->shifts()->attach($value);

        }

        return $movie;
    }


   
}