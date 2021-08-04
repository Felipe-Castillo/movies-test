<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;

class Create
{
    private $movia;


    public function __construct(
        Movie $movie

    )
    {
        $this->movie = $movie;

    }

    public function execute(Request $request)
    {
  

       $path = "public/images";

     if(!Storage::exists($path)){
    Storage::makeDirectory($path,0777);
     }


       $movie = $this->movie->create($request->all());
       $image_name='images/'.$movie->id.'/'.$request["cover"]["filename"];
       
       Storage::disk('public')->put($image_name,base64_decode($request["cover"]["value"]));


        $publication_date=Carbon\Carbon::parse($request->publication_date)->format('Y-m-d');
        

        $movie->publication_date=$publication_date;
        $movie->image=$image_name;
        $movie->save();


        return $movie;
    }


   
}