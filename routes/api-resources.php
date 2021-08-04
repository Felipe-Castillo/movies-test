<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'prefix' => 'resources',
	'namespace' => 'API',
	'middleware' => ['jwt.auth'],
], function(){


	//shifts
	Route::get('/shifts', 'ShiftController@get');

});
