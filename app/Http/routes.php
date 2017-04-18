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

//Auth::loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::group(['middleware' => ['web']],function(){

    Route::get('/home', 'HomeController@index');
    Route::resource('groups', 'GroupController');
    Route::resource('genes', 'GeneController');

    Route::resource('recommendations', 'RecommendationController');

    Route::get('admin', 'AdminController@index');
    Route::resource('analysis', 'AnalysisController');
    Route::get('types-option', 'GeneVariantsSearchController@search');
    Route::resource('results', 'ResultsController');

    Route::resource('users', 'UsersController');
    Route::get('roles-option', 'UsersController@rolesList');
});




