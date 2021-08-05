<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;


use App\Http\Requests\Shift\CreateRequest;
use App\Http\Requests\Shift\UpdateRequest;

use App\Datatables\Shift\ShiftDataTable;
use App\UseCases\Shift\Create;
use App\UseCases\Shift\Update;
use App\UseCases\Shift\Show;
use App\UseCases\Shift\Destroy;

class ShiftController extends Controller
{
   
	 public function dataTable(ShiftDataTable $table)
    {

        return $table->build();
    }

    public function store(
        CreateRequest $request,
        Create $create
    )
    {


        $create->execute($request->all());

        return response()->json([
            'message' => 'Turno registrado!'
        ]);
    }


    public function update(
        UpdateRequest $request,
        Update $update
    )
    {

        $update->execute($request->all());

        return response()->json([
            'message' => 'Turno modificado!'
        ]);
    }


    public function show(
        $id,
        Show $show
    )
    {
        $model = $show->execute($id);

        return response()->json($model);
    }

   
     public function destroy(
        Destroy $destroy,
         $id
    )
    {

         $destroy->execute($id);

        return response()->json([
            'message' => "Turno eliminado!"
        ]);
    }
  

}
