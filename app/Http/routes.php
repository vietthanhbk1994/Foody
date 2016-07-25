<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

//Route::auth();

Route::get('/home', 'HomeController@index');

/*
  |--------------------------------------------------------------------------
  | API routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::resource('tests', 'TestController');
Route::get('test', function(){
    return view("users.test");
});

Route::group(['middleware' => ['login']], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('pages', 'PageController');

    Route::resource('categories', 'CategoryController');

    Route::resource('foods', 'FoodController');
    
    Route::get('soncho', function(){
        if (Gate::denies('user')) {
            return redirect("/foods");
        }
        return "Duyen";
    });
    
    
    
    Route::group(['middleware' => ['admin']], function () {
        Route::resource('users', 'UserController');
    });
});