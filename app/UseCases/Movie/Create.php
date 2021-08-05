<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;

class Create
{
    private $movie;


    public function __construct(
        Movie $movie

    )
    {
        $this->movie = $movie;

    }

    public function execute(Request $request)
    {
  



       $movie = $this->movie->create($request->all());
       


        $publication_date=Carbon\Carbon::parse($request->publication_date)->format('Y-m-d');
        

        $movie->publication_date=$publication_date;
        $movie->save();


        return $movie;
    }


   
}