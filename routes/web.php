<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MealScheduleController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPhotosController;
use App\Http\Controllers\OrdersController;
use App\Models\Cook;
use App\Models\Rating;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\callback;

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

Route::post('/webhook', [MealScheduleController::class, 'webhook'])->name('checkout.webhook');

// Route::get('api/meals', [WelcomeController::class, 'meals']);
Route::resource('/meal_photos', MealPhotosController::class);
Route::get('/checkUser', [CookController::class, "checkCook"]);
Route::get('api/filtered-meals', [WelcomeController::class, 'filtered_meals']);

    // Place your routes that require session middleware here
    Route::get('/auth/google/callback', [AccountController::class, 'callback']);
    Route::get('/auth/google/return', [AccountController::class, 'return'])->name('auth.google');
    
    Route::get('/auth/facebook/callback', [AccountController::class, 'fb_callback']);
    Route::get('/auth/facebook/return', [AccountController::class, 'fb_return'])->name('auth.facebook');
    
    Route::get('/auth/microsoft/callback', [AccountController::class, 'azure_callback']);
    Route::get('/auth/microsoft/return', [AccountController::class, 'azure_return'])->name('auth.microsoft');
    Route::get('meals/{id}', [MealController::class, 'meals' ]);    

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    
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
    
    Route::resource('cook/order',OrdersController::class);
    Route::get('cook/calendar', [OrdersController::class, 'calendar']);
    Route::get('meal-schedule', [OrdersController::class, 'order' ])->name('meal-schedule');
    
    
   
    //photo Controller
    
    //Meal Schedule
    Route::resource('/schedule', MealScheduleController::class);
    Route::post('/checkout', [MealScheduleController::class, 'checkout']);
    Route::get('/calendar', [MealScheduleController::class, 'schedule']);
    Route::get('/check-meal-status', [MealScheduleController::class, 'checkMealStatus']);
    Route::get('/api/suggestions', [MealScheduleController::class, 'getSuggestions']);
    Route::get('/process_order/{id}',  [MealScheduleController::class, 'process_order']);
    Route::get('/return', [MealScheduleController::class, 'return'])->name('checkout.return');
    Route::get('/cancel', [MealScheduleController::class, 'cancel'])->name('checkout.cancel');
    
    //Meal Controller
    Route::resource('/meal', MealController::class);
    Route::put('meal/title/{id}', [MealController::class, 'title' ]);    
    Route::put('meal/limit/{id}', [MealController::class, 'limit' ]);
    Route::put('meal/status/{id}', [MealController::class, 'status' ]);
    Route::put('meal/price/{id}', [MealController::class, 'price' ]);    
    Route::put('meal/status/{id}', [MealController::class, 'status' ]);
    Route::put('meal/region/{id}', [MealController::class, 'region' ]);
    Route::put('meal/preference/{id}', [MealController::class, 'preference' ]);    
    Route::put('meal/ingredients/{id}', [MealController::class, 'ingredients' ]);
    
    Route::resource('cook/account', AccountController::class);
    Route::post('account-link/{id}', [AccountController::class, 'account_link']);
    //cook Controller
    Route::resource('/cook/menu', CookController::class);
    Route::get('/cook/setup', [CookController::class, 'setup']);
    Route::get('/become-a-cook/{newMealId}/price',[CookController::class, 'price' ]);
    Route::get('/become-a-cook/{newMealId}/photos', [CookController::class, 'photos' ]);
    Route::get('/become-a-cook/{newMealId}/region', [CookController::class, 'region' ]);
    Route::get('/become-a-cook/{newMealId}/meal-title',[CookController::class, 'title' ]);
    Route::get('/become-a-cook/{newMealId}/overview', [CookController::class, 'overview']);
    Route::get('/become-a-cook/{newMealId}/spotlight', [CookController::class, 'spotlight' ]);
    Route::get('/become-a-cook/{newMealId}/cook-limit', [CookController::class, 'cook_limit' ]);
    Route::get('/become-a-cook/{newMealId}/finishing-up', [CookController::class, 'finish_up' ]);
    Route::get('/become-a-cook', [CookController::class, 'pending_meal'])->name('become-a-cook');
    Route::get('/become-a-cook/{newMealId}/ingredients', [CookController::class, 'ingredients' ]);
    Route::get('/become-a-cook/{newMealId}/final-overview',[CookController::class, 'final_overview' ]);
    Route::get('/become-a-cook/{newMealId}/about-your-meal', [CookController::class, 'about_your_meal']);
    Route::get('/become-a-cook/{newMealId}/ordering-preference', [CookController::class, 'ordering_preference' ]);
});
