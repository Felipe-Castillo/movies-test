<?php

namespace App\UseCases\Movie;

use App\Models\Movie;

class Show
{
    private $model;

    public function __construct(
        Movie $model
    )
    {
        $this->model = $model;
    }

    public function execute($id)
    {
        $movie = $this->model->findOrFail($id);
        
        $movie->load('shifts');
        
        return compact('movie');
    }
}