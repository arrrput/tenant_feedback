<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\RequestUserController;

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
Route::post('/login', [UserApiController::class,'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserApiController::class,'fecth']);
    Route::post('logout', [UserApiController::class,'logout']);

    // Request by user
    Route::get('my_request', [RequestUserController::class,'index']);
    Route::post('my_request/store', [RequestUserController::class,'store']);
    
});
