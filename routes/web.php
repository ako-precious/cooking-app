<?php

use App\Http\Controllers\CookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MealScheduleController;
use App\Models\MealSchedule;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/welcomed', function () {
    return Inertia::render('Welcomed', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('api/meals', [WelcomeController::class, 'meals']);
Route::get('api/filtered-meals', [WelcomeController::class, 'filtered_meals']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/cook/setup', [CookController::class, 'setup']);
    Route::get('/become-a-cook/overview', function () {
        return Inertia::render('Cook/Overview');
    });
    Route::get('/become-a-cook/about-your-meal', function () {
        return Inertia::render('Cook/AboutYourMeal');
    });
    Route::get('/become-a-cook/region', function () {
        return Inertia::render('Cook/MealArea');
    });
    Route::get('/become-a-cook/cook-limit', function () {
        return Inertia::render('Cook/CookingLimit');
    });
    Route::get('/meal-schedule', [MealScheduleController::class, "schedule"]);
    Route::resource('/schedule', MealScheduleController::class);
    Route::get('/api/suggestions', [MealScheduleController::class, 'getSuggestions']);
});
