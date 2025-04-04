<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealScheduleController;
use App\Http\Controllers\CookController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WelcomeController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Other authenticated API routes here
});

// Route::get('meals', [WelcomeController::class, 'meals']);

Route::get('filtered-meals', [WelcomeController::class, 'filtered_meals']);
Route::resource('/rating', RatingController::class);
Route::get('ratings/{id}', [RatingController::class, 'rating']);

Route::get('/sort', [OrdersController::class, 'sort']);
Route::post('/upload-verification/{id}', [AccountController::class, 'uploadVerification']);

Route::put('/availability/{id}', [CookController::class, 'availability']);
Route::get('/availability/{id}', [CookController::class, 'availability']);

// routes/api.php
Route::post('/save-subscription', [PushSubscriptionController::class, 'store']);

Route::put('/agreement/{id}' , [WelcomeController::class, 'agree']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
