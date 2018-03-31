<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Auth protected routes
Route::middleware('auth:api')->group( function(){
  Route::get('/tasks', 'Api\TaskController@index')->name('api.tasks');
  Route::post('/tasks', 'Api\TaskController@store')->name('api.tasks.store');
  Route::post('/tasks/{id}/complete', 'Api\TaskController@complete')->name('api.tasks.complete');
  
});


