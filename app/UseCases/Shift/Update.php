<?php

namespace App\UseCases\Shift;

use App\Models\Shift;

class Update
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
        
        $model = $this->model->find($data["shift_id"]);

        $model->update($data);


       
        return $model;
    }


   
}