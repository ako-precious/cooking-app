<?php

use App\Http\Controllers\CookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MealScheduleController;
use App\Http\Controllers\MealController;
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
    Route::resource('cook', CookController::class);
    
    Route::get('/become-a-cook/overview', function () {
        return Inertia::render('Cook/BecomeCook/Overview');
    });
    Route::get('/become-a-cook/{newMealId}/overview', [CookController::class, 'overview']);
    Route::get('/become-a-cook/{newMealId}/about-your-meal', [CookController::class, 'about_your_meal']);
    Route::get('/become-a-cook/{newMealId}/region', [CookController::class, 'region' ]);
    Route::put('meal/region/{id}', [MealController::class, 'region' ]);
    Route::get('/become-a-cook/{newMealId}/cook-limit', [CookController::class, 'cook_limit' ]);
    Route::get('/become-a-cook/{newMealId}/spotlight', [CookController::class, 'spotlight' ]);
    Route::get('/become-a-cook/{newMealId}/ingredients', [CookController::class, 'ingredients' ]);
    Route::get('/become-a-cook/{newMealId}/photos', [CookController::class, 'photos' ]);
    Route::get('/become-a-cook/{newMealId}/meal-title',[CookController::class, 'title' ]);
    Route::get('/become-a-cook/{newMealId}/description', function () {
        return Inertia::render('Cook/BecomeCook/Description');
    });
    Route::get('/become-a-cook/{newMealId}/finishing-up', [CookController::class, 'finish_up' ]);
    Route::get('/meal-schedule', [MealScheduleController::class, "schedule"]);
    Route::resource('/schedule', MealScheduleController::class);
    Route::resource('/meal', MealController::class);
    Route::get('/api/suggestions', [MealScheduleController::class, 'getSuggestions']);
});
