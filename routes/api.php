<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StyleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/event'      , [EventController::class, 'index']);
Route::get('/event/{user}', [EventController::class, 'indexUser'])->whereAlphaNumeric('user');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/event', [EventController::class, 'store']);
Route::put('/event/{id}', [EventController::class, 'update']);
Route::delete('/event/{id}', [EventController::class, 'destroy']);
//Route::middleware('auth:sanctum')->resource('styles', StyleController::class);
Route::resource('style', StyleController::class);








//Route::resource('event', [EventController::class]);
//Route::apiResource('event', EventController::class);