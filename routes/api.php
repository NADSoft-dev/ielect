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

Route::post('auth','AppAuthController@login');
Route::group(['middleware' => ['authApp']], function () {
Route::post('user','AppAuthController@userInfo');
Route::post('user/update-token','AppAuthController@updateToken');
Route::get('electors/{id}','ElectorsController@getElector');
Route::post('electors','ElectorsController@getListApp');
Route::post('electors/vote','ElectorsController@markVoted');
Route::get('list','DelegateController@getListApp');
Route::get('parties','PageController@getPartiesApp');
Route::get('mayors','PageController@getMayorsApp');
Route::post('counted-votes','PageController@setCountedVotes');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
