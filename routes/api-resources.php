<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'prefix' => 'resources',
	'namespace' => 'API',
], function(){


	//shifts
	Route::get('/shifts', 'ShiftController@get');

	//movies

	 Route::get('get-movies', 'MovieController@get');


});
