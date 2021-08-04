<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'prefix'  	=> 'datatables',
	//'middleware' => ['jwt.auth'],
], function(){


//peliculas

Route::post('/movies','MovieController@dataTable');


// turnos

Route::post('/shifts','ShiftController@dataTable');




});