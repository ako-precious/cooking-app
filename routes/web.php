<?php

use App\Http\Controllers\CookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MealScheduleController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPhotosController;
use App\Models\Cook;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
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
    
    Route::get('/become-a-cook/overview', function () {
        $user_id =   Auth::id();      
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            return Inertia::render('Cook/BecomeCook/Overview');
        }else {
            # code...
            return redirect()->route('welcome',);
        }
    });
    
    Route::resource('/meal', MealController::class);
    Route::resource('/cook/menu', CookController::class);
    Route::get('/cook/setup', [CookController::class, 'setup']);
    Route::post('/checkout', [MealScheduleController::class, 'checkout']);
    Route::get('/process_order',  function () {  return Inertia::render('MealSchedule/Checkout');}
    );
    Route::get('/return', [MealScheduleController::class, 'return'])->name('checkout.return');
    Route::get('/cancel', [MealScheduleController::class, 'cancel'])->name('checkout.cancel');
    Route::post('/webhook', [MealScheduleController::class, 'webhook'])->name('checkout.webhook');
    Route::resource('/schedule', MealScheduleController::class);
    Route::resource('/meal_photos', MealPhotosController::class);
    Route::get('/checkUser', [CookController::class, "checkCook"]);
    Route::put('meal/title/{id}', [MealController::class, 'title' ]);    
    Route::put('meal/limit/{id}', [MealController::class, 'limit' ]);
    Route::put('meal/price/{id}', [MealController::class, 'price' ]);    
    Route::put('meal/region/{id}', [MealController::class, 'region' ]);
    Route::get('/become-a-cook', [CookController::class, 'pending_meal']);
    Route::put('meal/preference/{id}', [MealController::class, 'preference' ]);    
    Route::put('meal/ingredients/{id}', [MealController::class, 'ingredients' ]);
    Route::get('/meal-schedule', [MealScheduleController::class, 'schedule']);
    Route::get('/api/suggestions', [MealScheduleController::class, 'getSuggestions']);
    Route::get('/become-a-cook/{newMealId}/price',[CookController::class, 'price' ]);
    Route::get('/become-a-cook/{newMealId}/spotlight', [CookController::class, 'spotlight' ]);
    Route::get('/become-a-cook/{newMealId}/photos', [CookController::class, 'photos' ]);
    Route::get('/become-a-cook/{newMealId}/region', [CookController::class, 'region' ]);
    Route::get('/become-a-cook/{newMealId}/overview', [CookController::class, 'overview']);
    Route::get('/become-a-cook/{newMealId}/meal-title',[CookController::class, 'title' ]);
    Route::get('/become-a-cook/{newMealId}/cook-limit', [CookController::class, 'cook_limit' ]);
    Route::get('/become-a-cook/{newMealId}/ingredients', [CookController::class, 'ingredients' ]);
    Route::get('/become-a-cook/{newMealId}/finishing-up', [CookController::class, 'finish_up' ]);
    Route::get('/become-a-cook/{newMealId}/about-your-meal', [CookController::class, 'about_your_meal']);
    Route::get('/become-a-cook/{newMealId}/ordering-preference', [CookController::class, 'ordering_preference' ]);
    Route::get('/become-a-cook/{newMealId}/final-overview',[CookController::class, 'final_overview' ]);
});
