<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ApiEmailVerificationNotificationController;

use App\Http\Controllers\Auth\AccessTokenController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\UserController;

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

Route::get('/', function() {
    return 'welcome to the spa!';
});

Route::post('/users', [UserController::class, 'create']);

Route::post('/login', [ApiAuthController::class, 'login']);

/**
 * 
 * Protected routes with sanctum
 * users will need a token to access 
 * 
 */
Route::middleware('auth:sanctum')->group( function () {

    Route::Post('/logout', [ApiAuthController::class, 'logout']);

});