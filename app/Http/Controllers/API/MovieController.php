<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movie;

class MovieController extends Controller
{
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function get(Request $request)
    {
        $query = $this->movie->select('name','publication_date','status')->with('genre')->get();

       
        return response()->json($query);
    }
}