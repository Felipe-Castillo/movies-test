<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    //

    use SoftDeletes;

    protected $table="shifts";

    protected $fillable=["shift_hour","status"];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


  public function setShiftHourAttribute($value)
    {

    	$date=strtotime($value);
        $this->attributes['shift_hour'] = date('H:i:s', $date);

      
    }

    public function movies()
    {
    	return $this->belongsToMany(Movie::class,'movie_shift','shift_id','movie_id');
    }



}
