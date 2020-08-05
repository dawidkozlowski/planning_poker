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
Route::prefix('/leader')->group(function () {
    Route::get('/{name}/{title}/{number_of_seats}', 'LeaderController@storeWithRoom');
    Route::delete('/{id}', 'LeaderController@destroy');
});
Route::prefix('/player')->group(function() {
    Route::get('/{name}/{title}/{vote}', 'PlayerController@vote');
});
Route::get('/count/{title}', 'PlayerController@voteCounter');


