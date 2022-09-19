<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
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

Route::group(['middleware' => ['auth:sanctum']], function ()
{
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/event'      , [EventController::class, 'index']);
    Route::get('/event/{user}', [EventController::class, 'indexUser'])->whereAlphaNumeric('user');
    Route::post('/event', [EventController::class, 'store']);
    Route::get('/styles', function()
    {
        return response()->json([
            'JTP' => ['primary' => '#03fcdf', 'secondary' => '#04758f'],
            'CW'  => ['primary' => '#e8f0a3', 'secondary' => '#e2f252'],
            'ST'  => ['primary' => '#d99ee8', 'secondary' => '#c034e3'],
            'AM'  => ['primary' => '#abe3a1', 'secondary' => '#47d42f'],
            'EPR' => ['primary' => '#b596d9', 'secondary' => '#7b27db'],
            'BDM' => ['primary' => '#deb6a6', 'secondary' => '#deb6a6'],
            'GHA' => ['primary' => '#afd6a7', 'secondary' => '#35ba1a'],
            'BDP' => ['primary' => '#9f9fd6', 'secondary' => '#9f9fd6'],
            'MB'  => ['primary' => '#aa99de', 'secondary' => '#542bcf'],
            'MISC'=> ['primary' => '#c9939c', 'secondary' => '#cc354e']
        ]);
    });
});







//Route::resource('event', [EventController::class]);
//Route::apiResource('event', EventController::class);