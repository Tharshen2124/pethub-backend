<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    // UserController Routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'register'])->middleware('guest');
    Route::post('/login', [UserController::class, 'login'])->middleware('guest');
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::post('/logout', [UserController::class, 'logout']);
    }); 
}); 

