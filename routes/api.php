<?php
use App\Http\Controllers\api\V1\AdminController;
use App\Http\Controllers\api\V1\AppointmentController;
use App\Http\Controllers\api\V1\NewsController;
use App\Http\Controllers\api\V1\PetController;
use App\Http\Controllers\api\V1\ReportController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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
    Route::post('/register', [UserController::class, 'register'])->middleware('guest');
    Route::post('/login', [UserController::class, 'login'])->middleware('guest');

    Route::apiResource('/pets', PetController::class);
    Route::apiResource('/posts', PostController::class);
    
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [UserController::class, 'logout']);

        //Appointment routes
        Route::get('/appointments', [AppointmentController::class, 'index']);
        Route::post('/appointments', [AppointmentController::class, 'store']);
        Route::put('/appointments/{aptid}', [AppointmentController::class, 'update']);
        Route::get('/appointments/{spid}', [AppointmentController::class, 'show']);

        // News routes
        Route::apiResource('/news', NewsController::class)->only([
            'index', 'show', 'store'
        ]);

        // Admin routes
        Route::group(['prefix' => 'admin'], function() 
        {
            Route::get('/sp_application', [AdminController::class, 'show_service_provider']);
            Route::get('/sp_application/{spid}', [AdminController::class, 'show_specifc_service_provider']);
            Route::put('/sp_application/{spid}', [AdminController::class, 'service_provider_application']);
            
            Route::get('/news_application', [AdminController::class, 'show_news']);
            Route::get('/news_application/{nid}', [AdminController::class, 'show_specific_news']);
            Route::put('/news_application/{nid}', [AdminController::class, 'news_application']);
            
            Route::get('/report', [AdminController::class, 'show_reports']);
            Route::get('/report/{rid}', [AdminController::class, 'show_specific_report']);
            
            Route::get('/user', [AdminController::class, 'show_all_users']);
            Route::delete('/user/{uid}', [AdminController::class, 'delete_user']);
        });

        // Report routes
        Route::post('/report', [ReportController::class, 'store']);
    }); 

    
}); 
