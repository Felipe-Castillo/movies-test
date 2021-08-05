<?php

namespace App\UseCases\Shift;

use App\Models\Shift;

class Create
{
    private $model;


    public function __construct(
        Shift $model

    )
    {
        $this->model = $model;

    }

    public function execute(array $data)
    {
        
        $model = $this->model->create($data);


        return $model;
    }


   
}