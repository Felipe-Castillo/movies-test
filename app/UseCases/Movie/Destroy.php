<?php

namespace App\UseCases\Movie;

use App\Models\Movie;

class Destroy
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
        return  $this->model->destroy($id);
    }
}