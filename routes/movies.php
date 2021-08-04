<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'movies'], function(){

     Route::post('shift-assign', 'MovieController@shift_assign');

     Route::get('get-movies', 'MovieController@get');

});