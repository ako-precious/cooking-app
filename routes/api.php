<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealScheduleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::get('meals', [WelcomeController::class, 'meals']);
Route::get('filtered-meals', [WelcomeController::class, 'filtered_meals']);
Route::post('/webhook', [MealScheduleController::class, 'webhook'])->name('checkout.webhook');
Route::resource('/rating', RatingController::class);
    Route::get('ratings/{id}', [RatingController::class, 'rating' ]);   