<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('tests', 'TestAPIController');

Route::resource('pages', 'PageAPIController');

Route::resource('categories', 'CategoryAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('users', 'UserAPIController');