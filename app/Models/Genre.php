<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //

    use SoftDeletes;

    protected $table="genres";

    protected $fillable=["name"];

    protected $dates = [
        'created_at',
        'updated_at',
        'publication_date'
    ];


      public function movies()
    {
    	return $this->hasMany(Shift::class,'genre_id');
    }

}
