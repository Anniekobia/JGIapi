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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','API\AuthController@register');
Route::post('/login','API\AuthController@login');

//AppUser routes
Route::apiResource('/AppUser','API\AppUserController');
Route::post('/authenticate','API\AppUserController@authenticate');
//AppUserDetails routes
Route::post('/updateuserdetails','API\AppUserDetailsController@updateuserdetails');
//Route::controller('authenticate', 'API\AppUserController@authenticate');