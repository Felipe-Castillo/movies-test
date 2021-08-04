<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shift;

class ShiftController extends Controller
{
    protected $shift;

    public function __construct(Shift $shift)
    {
        $this->shift = $shift;
    }

    public function get(Request $request)
    {
        $query = $this->shift->select('id','shift_hour')->get();

       
        return response()->json($query);
    }
}