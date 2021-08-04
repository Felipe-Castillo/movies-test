<?php

namespace App\UseCases\Shift;

use App\Models\Shift;

class Show
{
    private $model;

    public function __construct(
        Shift $model
    )
    {
        $this->model = $model;
    }

    public function execute($id)
    {
        $shift = $this->model->findOrFail($id);
        
        $shift->load('movies');

        return compact('shift');
    }
}