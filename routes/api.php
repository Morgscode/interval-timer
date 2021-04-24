<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IntervalController;

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

/**
 * 
 * for testing the connection - dev only
 * 
 */
Route::get('/', function() {
    return 'welcome to the spa!';
});

Route::post('/users', [UserController::class, 'store']);

Route::post('/login', [ApiAuthController::class, 'login']);

/**
 * 
 * Protected routes with sanctum
 * users will need a token to access 
 * 
 */

Route::middleware('auth:sanctum')->group( function () {

    Route::post('/logout', [ApiAuthController::class, 'logout']);

    /**
     * 
     * There routes will assess that user id
     * given in the path matches the current
     * user making the request
     * 
     */

    Route::middleware('check.user')->group( function () {

        Route::get('/users/{user}/intervals', [IntervalController::class, 'index']);
        Route::post('/users/{user}/intervals', [IntervalController::class, 'store']);

        Route::get('/users/{user}/intervals/{interval}',[IntervalController::class, 'show']);
        Route::put('/users/{user}/intervals/{interval}', [IntervalController::class, 'update']);
        Route::delete('users/{user}/intervals/{interval}', [IntervalController::class, 'destroy']);

    });

});
