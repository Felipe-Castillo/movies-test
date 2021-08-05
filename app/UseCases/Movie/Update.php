<?php

namespace App\UseCases\Movie;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon;

class Update
{
    private $model;


    public function __construct(
        Movie $model

    )
    {
        $this->model = $model;

    }

    public function execute(Request $request)
    {
        $model = $this->model->find($request["movie_id"]);

        if (isset($request["cover"]["filename"])) 
        {
        $image_name='images/'.$model->id.'/'.$request["cover"]["filename"];
       
       Storage::disk('public')->put($image_name,base64_decode($request["cover"]["value"]));
        }else
        {
        $image_name=$request->cover;

        }

        $request->merge(["image"=>$image_name]);


        $model->update($request->all());


       
        return $model;
    }


   
}