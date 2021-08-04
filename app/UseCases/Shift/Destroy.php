<?php

namespace App\UseCases\Shift;

use App\Models\Shift;
use App\Models\Movie;

class Destroy
{
    private $model;
    private $movie;

    public function __construct(
        Shift $model,
        Movie $movie
    )
    {
        $this->model = $model;
        $this->movie = $movie;

    }

    public function execute($id)
    {

         $m= $this->model->find($id);

        foreach ($m->movies as $key => $value) 
        {
            $value->shifts()->detach($id);
        
        }

        return  $this->model->destroy($id);
    }


}