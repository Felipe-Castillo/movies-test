<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'emails'], function(){


     Route::get('send-email', 'MovieController@send');

});