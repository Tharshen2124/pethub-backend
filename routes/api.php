<?php

use App\Http\Controllers\api\V1\AppointmentController;
use App\Http\Controllers\api\V1\NewsController;
use App\Http\Controllers\api\V1\PetController;
use App\Http\Controllers\api\V1\ReportController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\V1\AdminController;


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

Route::group(['prefix' => 'v1'], function () {

    // User routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'register'])->middleware('guest');
    Route::post('/login', [UserController::class, 'login'])->middleware('guest');
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::apiResource('/pets', PetController::class);
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/news', NewsController::class);
    Route::apiResource('/reports', ReportController::class);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [UserController::class, 'logout']);

        //Appointment routes
        Route::get('/appointments', [AppointmentController::class, 'index']);
        Route::post('/appointments', [AppointmentController::class, 'store']);
        Route::put('/appointments/{aptid}', [AppointmentController::class, 'update']);
        Route::get('/appointments/{spid}', [AppointmentController::class, 'show']);
    }); 

    Route::group(['prefix' => 'admin'], function() {
        Route::put('/service_provider_application', [AdminController::class, 'service_provider_application']);
    });
}); 
