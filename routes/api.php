<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\http\Controllers\Api\apicontroller;
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

Route::post('saverecord','Api\apicontroller@saverecord');
Route::post('saverecordSecured','Api\apicontroller@saverecordSecured');


Route::post('authenticate','Api\apicontroller@authenticate');
