<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\SessionController;

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
 * Guest routes for unregistered users
 * 
 */

Route::post('/users', [UserController::class, 'store']);

Route::post('/login', [ApiAuthController::class, 'login']);

/**
 * 
 * Protected routes with sanctum
 * users will need a token to access 
 * 
 */

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/users/{user}', [UserController::class, 'show']);

    Route::post('/logout', [ApiAuthController::class, 'logout']);

    /**
     * 
     * There routes will assess that user id
     * given in the path matches the current
     * user making the request
     * 
     */
    
    Route::middleware('check.user')->group( function () {

        /**
         * 
         * Interval Routes
         * 
         */

        Route::post('/users/{user}/images', [ProfilePhotoController::class, 'update']);

        Route::get('/users/{user}/intervals', [IntervalController::class, 'index']);
        Route::post('/users/{user}/intervals', [IntervalController::class, 'store']);

        Route::get('/users/{user}/intervals/{interval}',[IntervalController::class, 'show']);
        Route::put('/users/{user}/intervals/{interval}', [IntervalController::class, 'update']);
        Route::delete('users/{user}/intervals/{interval}', [IntervalController::class, 'destroy']);

        /**
         * 
         * Session Route
         * 
         */

        Route::get('/users/{user}/sessions', [SessionController::class, 'index']);
        Route::post('/users/{user}/sessions', [SessionController::class, 'store']);

        Route::get('/users/{user}/sessions/{session}',[SessionController::class, 'show']);
        Route::put('/users/{user}/sessions/{session}', [SessionController::class, 'update']);
        Route::delete('users/{user}/sessions/{session}', [SessionController::class, 'destroy']);

    });

});
