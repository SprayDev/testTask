<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/calculate', 'fbController@calculate');
Route::post('/excel/get', 'fbController@getExcel');
Route::put('/excel/load', 'fbController@excelPut');
Route::put('/vk/create', 'fbController@vkCreate');
Route::put('/put/xyz', 'coordinateController@putXY');
Route::get('/put/xyz1', 'coordinateController@putXYZ');
Route::get('/get/data', 'coordinateController@getData');
