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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('mainmenu','Controller@getMainMenu');

Route::group(['middleware' => 'jwt.auth'], function ($router) {
//    Route::get('quest/customers', 'CustomersController@all');
    Route::post('quest/add', 'SurveyController@add');
    Route::get('quest','SurveyController@list');
    Route::get('users','UserController@list');
    Route::get('roles','UserController@getroles');
    Route::post('users/store','UserController@store');
    Route::post('users/update', 'UserController@update');
    Route::post('users/delete/{id}','UserController@destroy');
    Route::get('articles', 'ArticleController@list');
});