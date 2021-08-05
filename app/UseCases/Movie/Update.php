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



        $model->update($request->all());


       
        return $model;
    }


   
}