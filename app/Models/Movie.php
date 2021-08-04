<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
   
    use SoftDeletes;

    protected $table="movies";

    protected $fillable=["name","publication_date","status","genre_id"];

    protected $dates = [
        'created_at',
        'updated_at',
        'publication_date'
    ];


      public function shifts()
    {
    	return $this->belongsToMany(Shift::class,'movie_shift','movie_id','shift_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class,'genre_id');
    }

}
