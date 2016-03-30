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

Route::group(['middleware' => ['web']], function () {
  Route::get('/','PagesController@home');
  /*Also you can use this syntax
  Route::get('/', ['as' => 'home','uses' => 
    'PagesController@home']);*/

  //This single route creates multiple routes to handle a variety of RESTful actions on the resource such as create, store, show .. and so on 

  //index method by default  
  Route::resource('/tasks','TasksController'); 

});
